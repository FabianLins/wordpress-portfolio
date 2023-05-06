<?php
echo ("<div class='project'>");
    echo ("<div class='container-parent'>");
        echo ("<div class='container grid'>");
            $leftDelay = "";
            switch ($i) {
                case 1:
                    $leftDelay = "delay";
                    break;
                case 2:
                    $leftDelay = "delay-2";
                    break;
                case 3:
                    $leftDelay = "delay-3";
                    break;
            }
            echo ("<div class='left animation-slide-in-right " . $leftDelay . "'>");
                echo ("<h3 class='h3'>" . $headlineContent . "</h3>");
                echo ("<div class='project-info'>");
                    echo ("<div class='made-with'>");
                        echo ("<div class='wheel animation-wheel-icon'>");
                            $src = get_template_directory_uri() . "/svg/wheel.svg";
                            $svg = wp_remote_get($src);
                            $svg = wp_remote_retrieve_body($svg);
                            echo ($svg);
                        echo ("</div>"); // wheel
                        echo ("<div class='text'>");
                            echo ($projectInfo[0]);
                        echo ("</div>"); // text
                    echo ("</div>"); // made with
                    echo ("<div class='created-in'>");
                        echo ("<div class='calender'>");
                            echo ("<div class='circle-container animation-clock animation-slower'>");
                                echo ("<div class='circle'>");
                                    echo ("<div class='dot'>");
                                    echo ("</div>"); // dot
                                    echo ("<div class='sm-pointer'>");
                                    echo ("</div>"); // sm-pointer
                                    echo ("<div class='lg-pointer'>");
                                    echo ("</div>"); // lg-pointer
                                echo ("</div>"); // circle
                            echo ("</div>"); // circle-container
                            $src = get_template_directory_uri() . "/svg/calender.svg";
                            $svg = wp_remote_get($src);
                            $svg = wp_remote_retrieve_body($svg);
                            echo ($svg);
                        echo ("</div>"); // calender
                        echo ("<div class='text'>");
                            echo ($projectInfo[1]);
                        echo ("</div>"); // text
                    echo ("</div>"); // created in
                echo ("</div>"); // project-info
                echo ("<div class='buttons grid'>");
                    foreach ($buttons as $currButton) {
                        $target    = "";
                        $currStr   = strtolower($currButton["content"]);
                        $addClass  = "";
                        $icon      = "";
                        $animation = "animation-button-blink";
                        if (strpos($currStr, "github") !== false) {
                            $addClass = "github " . $animation . "-github";
                            $src      = get_template_directory_uri() . "/svg/github.svg";
                        } elseif (strpos($currStr, "show more") !== false) {
                            $addClass = "more " . $animation . "-more";
                            $src      = get_template_directory_uri() . "/svg/show-more.svg";
                        } elseif (strpos($currStr, "demo") !== false) {
                            $addClass = "demo " . $animation . "-demo";
                            $src      = get_template_directory_uri() . "/svg/world.svg";
                        }
                        $icon = wp_remote_get($src);
                        $icon = wp_remote_retrieve_body($icon);
                        if (strpos($currStr, "show more") !== false) {
                            echo ("<label tabindex=0 class='js-checkbox-keyboard js-modal-label button-container " . $addClass . "' for='" . $modal . "'>");
                                echo $icon;
                                echo ("<span>" . $currButton["content"] . "</span>");
                            echo ("</label>"); // button-container
                        } else {
                            if (!$currButton["href"]) {
                                $currButton["href"] = '#';
                            }
                            if ($currButton["new-tab"]) {
                                $target = " target='_blank'";
                            }
                            echo ("<a class='button-container " . $addClass . "' href=" . $currButton["href"] . $target . ">");
                                echo $icon;
                                echo ("<span>" . $currButton["content"] . "</span>");
                            echo ("</a>"); // button-container
                        }
                    }
                echo ("</div>"); // buttons
            echo ("</div>"); // left
            $rightDelay = "";
            switch ($i) {
                case 1:
                    $rightDelay = "delay";
                    break;
                case 2:
                    $rightDelay = "delay-2";
                    break;
                case 3:
                    $rightDelay = "delay-3";
                    break;
            }
            echo ("<div class='right animation-slide-in-left " . $rightDelay . "'>");
                echo ("<div class='right-content'>");
                    if($projectState === "{#finished}"){
                        echo ("<div class='project-state finished'>");
                            echo ("<div class='icon animation-draw-tick'>");
                                $src = get_template_directory_uri() . "/svg/tick.svg";
                                $svg = wp_remote_get($src);
                                $svg = wp_remote_retrieve_body($svg);
                                echo ($svg);    
                            echo ("</div>"); // icon
                            echo ("<div class='project-state-text'>");
                                echo ("Finished");
                            echo ("</div>"); // project-state-text 
                        echo ("</div>"); // project-state
                    }
                    elseif($projectState === "{#in progress}"){
                        echo ("<div class='project-state in-progress animation-clock'>");
                            echo ("<div class='circle'>");
                                echo ("<div class='lg-pointer'>");
                                echo ("</div>"); // lg-pointer
                                echo ("<div class='sm-pointer'>");
                                echo ("</div>"); // sm-pointer
                                echo ("<div class='dot'>");
                                echo ("</div>"); // dot
                            echo ("</div>"); // circle
                            echo ("<div class='project-state-text'>");
                                echo ("In Progress");
                            echo ("</div>"); // project-state-text 
                        echo ("</div>"); // project-state
                    }
                    echo ("<div class='bg'></div>");
                    echo ("<img src=" . wp_get_attachment_image_src($imgID,[1000, 1000])[0] . " alt='' />");
                echo ("</div>"); // right-content  
            echo ("</div>"); // right
        echo ("</div>"); // container
    echo ("</div>"); // container-parent
    foreach($subPages as $currPage){
        if($currPage->post_name === $modal){
            echo ("<input type='checkbox' id='" . $modal ."' name='modalboxes'>");
            echo ("<div class='modal-container'>");
                echo ("<input type='radio' id='" . $modal ."-min' name='". $modal ."-min-max'>");
                echo ("<input type='radio' id='" . $modal ."-max' name='". $modal ."-min-max'>");
                echo ("<div class='modal animation-modal-fade-in'>");
                    echo ("<div class='modal-top'>");
                        echo ("<div class='mac-buttons'>");
                            echo ("<label tabindex=0 class='red animation-mac-red-blink js-modal-close js-checkbox-keyboard' for='" . $modal . "'></label>");
                            echo ("<label tabindex=0 class='yellow animation-mac-yellow-blink js-checkbox-keyboard' for='" . $modal . "-min'></label>");
                            echo ("<label tabindex=0 class='green animation-mac-green-blink js-checkbox-keyboard' for='" . $modal . "-max'></label>");
                        echo ("</div>"); // mac-buttons
                    echo ("</div>"); // modal-top
                    echo ("<div tabindex=0 class='modal-content'>");
                        echo (sanitizeMarkup($currPage->post_content));
                    echo ("</div>"); // modal-content
                echo ("</div>"); // modal
                echo ("<label class='modal-shadow animation-shadow-fade-in js-modal-close' for='" . $modal ."'>");
                echo ("</label>"); // modal-shadow    
            echo ("</div>"); // modal-container
            break;
        }
    }
echo ("</div>"); // project