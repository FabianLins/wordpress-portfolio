<?php
include "inc/helpers.php";
get_header();

$logo     = get_theme_mod("custom_logo");
$image    = wp_get_attachment_image_src($logo, "full");
$logoPath = $image[0];

?>
<section class="about-me">
    <h2 class="h2 mt-header h-pl animation-slide-in-right">
        <?php the_title(); ?>
    </h2>
    <div class="container">
        <div class="grid">
            <div class="left animation-slide-in-right">
                <div class="text-box">
                    <?php
                    if (have_posts()) {
                        while (have_posts()) {
                            the_post();
                            the_content();
                        }
                    }
                    ?>
                </div>
                <?php if ($logoPath) {
                    echo ("<div class='photo'>");
                        echo ("<img src=" . $logoPath . " alt=''>");
                    echo ("</div>");
                } ?>
                <div class="buttons">
                    <div class="btn-1">
                        <a href="#href-projects" class="prim-btn big animation-button-blink" onclick="unlockProjects()">
                            <?php // unlockProjects() => home.js ?>
                            Projects
                        </a>
                    </div>
                    <div class="btn-2">
                        <a href="#href-skills" class="prim-btn big animation-button-blink animation-delay"
                            onclick="unlockSections()">
                            <?php // unlockSections() => scroll.js ?>
                            List of skills
                        </a>
                    </div>
                </div>
            </div>
            <?php if ($logoPath) {
                echo ("<div class='right'>");
                    echo ("<div class='photo animation-slide-in-left animation-spin-in'>");
                        echo ("<img src=" . $logoPath . " alt=''>");
                    echo ("</div>");
                echo ("</div>");
            } ?>
        </div>
    </div>
    <img class="wheel-icon animation-spin" src="<?php echo (get_template_directory_uri() . "/svg/wheel.svg"); ?>"
        alt="" draggable="false"/>
</section>
<?php
include "template-parts/pages/page_projects/page_projects.php";
include "template-parts/pages/page_skills/page_skills.php";
get_footer();
?>
</body>

</html>