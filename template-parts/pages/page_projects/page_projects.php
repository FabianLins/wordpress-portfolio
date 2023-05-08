<?php
$query    = new WP_Query(array("pagename" => "projects"));
$content  = ($query->queried_object->post_content);
$content  = str_replace("<strong>", "", $content);
$content  = str_replace("</strong>", "", $content);
$projects = explode("<!-- wp:heading -->", $content);
unset($projects[0]);
$projects    = array_values($projects);
$projectsLen = count($projects);
$subPages    = get_pages(
    array(
        "child_of"    => $query->queried_object->ID,
        "post_status" => array("publish", "private")
    )
);
$finalBlock  = "";
foreach ($subPages as $currPage) {
    if ($currPage->post_name === "final-block") {
        $finalBlock = $currPage->post_content;
    }
}
$title = $query->queried_object->post_title;

?>

<section class="projects">
    <div class="header-container">
        <h2 id="href-projects" class="h2 h-pl animation-slide-in-right">
            <?php echo $title; ?>
        </h2>
    </div>
    <div class="all-projects">
        <?php
        for ($i = 0; $i < $projectsLen; $i++) {
            $currProject = $projects[$i];
            // Controller
            include "ctr/page_projects_ctr_single_project.php";
            // HTML output
            include "html/page_projects_html_single_project.php";
        }
        // Final Block
        if ($finalBlock !== "") {
            // Controller
            include "ctr/page_projects_ctr_final_block.php";
            // HTML output
            include "html/page_projects_html_final_block.php";
        }
        ?>
    </div>
</section>