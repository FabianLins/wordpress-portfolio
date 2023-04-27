<?php
/* Template Name: List of skills */
get_header();
?>

<section class="list-of-skills">
    <h2 class="h2 mt-header h-pl animation-slide-in-right">
        <?php the_title() ?>
    </h2>
    <div class="container">
        <?php
            if (have_posts()) {
                while (have_posts()) {
                    the_post();
                    $content       = get_the_content();
                    $categories    = explode("<!-- /wp:list -->", $content, -1);
                    $categoriesLen = count($categories);
                    for ($i = 0; $i < $categoriesLen; $i++) {
                        $categories[$i] = $categories[$i] . "<!-- /wp:list -->";
                    }
                    for ($i = 0; $i < $categoriesLen; $i++) {
                        if (preg_match("/<h(1|2|3|4|5|6).*?>(.*?)<\/h.*?>/", $categories[$i], $matches)) {
                            $listStart = strpos($categories[$i], "<ul>");
                            $listContent = substr($categories[$i], $listStart);
                            $listContent = str_replace("<ul>", "", $listContent);
                            $listContent = str_replace("</ul>", "", $listContent);
                            $listContent = str_replace("<!-- /wp:list -->", "", $listContent);
                            $listContent = str_replace("<!-- wp:list-item -->", "", $listContent);
                            $listContent = explode("<!-- /wp:list-item -->", $listContent, -1);
                            $listContentLen = count($listContent);
                            echo ("<div class='category-container grid'>");
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
                                    echo ("<div class='skill-heading-content'>");
                                        echo ("<h2 class='skill-heading'>");
                                            echo ($matches[2]);
                                        echo ("</h2>"); // skill-heading
                                        echo ("<ul class='skills'>");
                                        foreach($listContent as $currListContent){
                                            $stars = 0;
                                            if (preg_match("/{(1|2|3|4|5)s}/", $currListContent, $matches)) {
                                                $stars = $matches[1];
                                                $currListContent = str_replace($matches[0], "", $currListContent);
                                            }
                                            echo ("<div class='skills-point grid'>");
                                                echo ($currListContent);
                                                echo ("<div class='rating-container'>");
                                                    echo ("<div class='rating'>");
                                                    for ($j = 0; $j < $stars; $j++) {
                                                        $src = wp_get_attachment_image_src(71)[0];
                                                        echo ("<img class='star-full' src=" . $src . " alt='' /> ");
                                                    }
                                                    for ($j = 0; $j < 5 - $stars; $j++) {
                                                        $src = wp_get_attachment_image_src(67)[0];
                                                        echo ("<img class='star-outline' src=" . $src . " alt='' /> ");
                                                    }
                                                    echo ("</div>"); // rating
                                                echo ("</div>"); // rating-container
                                            echo ("</div>"); // skills-point
                                        }
                                        echo ("</ul>");// skills
                                    echo ("</div>");// skill-heading-content
                                echo ("</div>");// left
                                if($i === 0){ // front end icon
                                    echo ("<div class='right animation-slide-in-left'>");
                                        echo ("<input id='default' class='mac-dot-input' type='radio' name='mac-dots' checked>");
                                        echo ("<input id='red-dot' class='mac-dot-input' type='radio' name='mac-dots'>");
                                        echo ("<input id='yellow-dot' class='mac-dot-input' type='radio' name='mac-dots'>");
                                        echo ("<input id='green-dot' class='mac-dot-input' type='radio' name='mac-dots'>");
                                        echo ("<div class='icon front-end-icon'>");
                                            $src = get_template_directory_uri() . "/svg/cursor.svg";
                                            echo ("<img class='cursor animation-cursor-move' src=". $src ." />");
                                            echo ("<img class='cursor animation-cursor-move cursor-shadow' src=". $src ." />");
                                            echo ("<div class='window-container-container'>");
                                                echo ("<div class='window-container'>");
                                                    echo ("<div class='window'>");
                                                        echo ("<div class='top'>");
                                                            echo ("<div class='dots'>");
                                                                echo ("<label for='red-dot' class='red animation-mac-red-blink'></label>"); // red
                                                                echo ("<label for='yellow-dot' class='yellow animation-mac-yellow-blink'></label>"); // yellow
                                                                echo ("<label for='green-dot'class='green animation-mac-green-blink'></label>"); // green
                                                            echo ("</div>"); // dots
                                                        echo ("</div>"); // top
                                                        echo ("<div class='bottom'>");
                                                            echo ("<div class='tag-close'>");
                                                            echo ("</div>"); // tag-close
                                                        echo ("</div>"); // bottom
                                                    echo ("</div>"); // window
                                                echo ("</div>"); // window-container
                                            echo ("</div>"); // window-container-container
                                        echo ("</div>"); // front-end-icon
                                    echo ("</div>"); // right
                                }
                                elseif($i === 1){ // back end icon
                                    echo ("<div class='right animation-slide-in-left delay'>");
                                        echo ("<label for='back-end-checkbox' class='back-end-icon-container'>");
                                            echo("<input type='checkbox' name='back-end-checkbox' id='back-end-checkbox'>");
                                            echo ("<div class='icon back-end-icon'>");
                                                echo ("<div class='wheels'>");
                                                    $src = get_template_directory_uri() . "/svg/wheel.svg";
                                                    echo ("<img class='wheel-top animation-wheel-top' src=". $src . " alt='' />");
                                                    $srcClipping = get_template_directory_uri() . "/svg/wheel-clipping-mask.svg";
                                                    echo ("<img class='wheel-top-clipping animation-wheel-top-clipping' src=". $srcClipping . " alt='' />");
                                                    echo ("<img class='wheel-bot animation-wheel-bot' src=". $src . " alt='' />");
                                                echo ("</div>"); // wheels
                                            echo ("</div>"); // back-end-icon
                                        echo ("</label>"); // parent
                                    echo ("</div>"); // right
                                }
                            echo ("</div>");// category-container
                        }
                    }
                }
            }
        ?>
    </div>
    <img class="wheel-icon animation-spin" src="<?php echo (get_template_directory_uri() . "/svg/wheel.svg"); ?>" alt="" />
</section>
<?php
get_footer();
?>
</body>