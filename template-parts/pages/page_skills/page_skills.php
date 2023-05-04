<?php
$query         = new WP_Query(array('pagename' => 'list-of-skills'));
$content       = ($query->queried_object->post_content);
$title         = $query->queried_object->post_title;
$categories    = explode("<!-- /wp:list -->", $content, -1);
$categoriesLen = count($categories);
for ($i = 0; $i < $categoriesLen; $i++) {
    $categories[$i] = $categories[$i] . "<!-- /wp:list -->";
}
?>

<section id="href-skills" class="list-of-skills">
    <h2 class="h2 mt-header h-pl animation-slide-in-right delay-4">
        <?php echo $title; ?>
    </h2>
    <div class="container">
        <?php
        for ($i = 0; $i < $categoriesLen; $i++) {
            if (preg_match("/<h(1|2|3|4|5|6).*?>(.*?)<\/h.*?>/", $categories[$i], $matches)) {
                $listStart      = strpos($categories[$i], "<ul>");
                $listContent    = substr($categories[$i], $listStart);
                $listContent    = str_replace("<ul>", "", $listContent);
                $listContent    = str_replace("</ul>", "", $listContent);
                $listContent    = str_replace("<!-- /wp:list -->", "", $listContent);
                $listContent    = str_replace("<!-- wp:list-item -->", "", $listContent);
                $listContent    = explode("<!-- /wp:list-item -->", $listContent, -1);
                $listContentLen = count($listContent);
                include "page_skills_html.php";
            }
        }
        ?>
    </div>
    <img class="wheel-icon animation-spin" src="<?php echo (get_template_directory_uri() . "/svg/wheel.svg"); ?>"
        alt="" />
</section>