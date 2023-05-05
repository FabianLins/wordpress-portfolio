<?php
echo("<div class='project final-block'>");
    echo ("<div class='container'>");
        echo ("<div class='relative'>");
            echo ("<div class='content'>");
                echo ("<h3 class='h3'>" . $finalHeadlineContent . "</h3>");
                echo ("<p>" . $finalParagraphs[0] . "</p>");
                echo ("<div class='buttons grid'>");
                    foreach ($finalButtons as $finalCurrButton) {
                        $target    = "";
                        $finalCurrStr   = strtolower($finalCurrButton["content"]);
                        $addClass  = "";
                        $icon      = "";
                        $animation = "animation-button-blink";
                        if (strpos($finalCurrStr, "github") !== false) {
                            $addClass = "github " . $animation . "-github";
                            $src      = get_template_directory_uri() . "/svg/github.svg";
                            $svg = wp_remote_get($src);
                            $icon = wp_remote_retrieve_body($svg);
                        } 
                        if (!$finalCurrButton["href"]) {
                            $finalCurrButton["href"] = '#';
                        }
                        if ($finalCurrButton["new-tab"]) {
                            $target = " target='_blank'";
                        }
                        echo ("<a class='button-container " . $addClass . "' href=" . $finalCurrButton["href"] . $target . ">");
                            echo $icon;
                            echo ("<span>" . $finalCurrButton["content"] . "</span>");
                        echo ("</a>"); // button-container
                    }
                echo ("</div>"); // buttons
                echo ("<div class='image-container'>");
                    //$finalImgID
                    echo ("<img src=" . wp_get_attachment_image_src($finalImgID, [1000, 1000])[0] . " alt='' />");
                echo ("</div>"); // image-container 
            echo ("</div>"); // content    
        echo ("</div>"); // relative
    echo ("</div>"); // container
echo ("</div>"); // final-block 