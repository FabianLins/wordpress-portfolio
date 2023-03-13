<?php
get_header();
?>
<section class="about-me list-of-skills">
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
                        //print_r($matches);
                        $listStart = strpos($categories[$i], "<ul>");
                        $listContent = substr($categories[$i],$listStart);
                        $listContent = str_replace("<ul>","",$listContent);
                        $listContent = str_replace("</ul>","",$listContent);
                        $listContent = str_replace("<!-- /wp:list -->","",$listContent);
                        $listContent = str_replace("<!-- wp:list-item -->","",$listContent);
                        $listContent = explode("<!-- /wp:list-item -->", $listContent, -1);
                        $listContentLen = count($listContent);
                        echo ("<div class='cateogory-container grid'>");
                            echo ("<div class='left'>");
                                echo ("<h2 class='skill-heading'>" . $matches[2] . "</h2>");
                                echo ("</h2>");// skill-heading
                                echo ("<ul class='skills'>");
                                foreach($listContent as $currListContent){
                                    $stars = 0;
                                    if (preg_match("/{(1|2|3|4|5)s}/", $currListContent, $matches)) {
                                        $stars = $matches[1];
                                        $currListContent = str_replace($matches[0],"",$currListContent);
                                    }
                                    echo ("<div class='skills-point grid'>");
                                        echo ($currListContent);
                                        echo ("<div class='rating'>");
                                        for ($j = 0; $j < $stars; $j++) {
                                            $src = wp_get_attachment_image_src(57)[0];
                                            echo("<img class='star-full' src=".$src." alt='' /> ");
                                        }
                                        for ($j = 0; $j < 5 - $stars; $j++) {
                                            $src = wp_get_attachment_image_src(56)[0];
                                            echo("<img class='star-outline' src=".$src." alt='' /> ");
                                        }
                                        echo ("</div>");//rating

                                    echo ("</div>"); // skills-point
                                }
                                echo ("</ul>");// skills
                            echo ("</div>");// left
                            echo ("<div class='right'>");
                                echo ("container-right-content");
                            echo ("</div>");// right
                        echo ("</div>");// category-container
                    }
                }
            }
        }
        //print_r($categories);
        //for($i = 0; $i < $lists; $i++){ //} //print_r($lists); //print_r($content); } } ?>
    </div>
    <img class="wheel-icon animation-spin" src="<?php echo (wp_get_attachment_image_src(35)[0]); ?>" alt="" />
</section>
<?php
get_footer();
?>
</body>