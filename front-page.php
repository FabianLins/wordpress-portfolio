<?php
include "inc/helpers.php";
get_header();

$logoPath = get_template_directory_uri() . "/assets/images/logo.png";
if (function_exists("the_custom_logo")) {
    $logo     = get_theme_mod("custom_logo");
    $image    = wp_get_attachment_image_src($logo, "full");
    $logoPath = $image[0];
}

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
                <div class="photo">
                    <img src="<?php echo $logoPath; ?>" alt="">
                </div>
                <div class="buttons">
                    <div class="btn-1">
                        <a href="#href-projects" class="prim-btn big animation-button-blink js-home-btn">
                            Projects
                        </a>
                    </div>
                    <div class="btn-2">
                        <a href="#href-skills" class="prim-btn big animation-button-blink animation-delay js-home-btn">
                            List of skills
                        </a>
                    </div>
                </div>
            </div>
            <div class="right">
                <div class="photo animation-slide-in-left animation-spin-in">
                    <img src="<?php echo $logoPath; ?>" alt="">
                </div>
            </div>
        </div>
    </div>
    <img class="wheel-icon animation-spin" src="<?php echo (get_template_directory_uri() . "/svg/wheel.svg"); ?>"
        alt="" />
</section>
<?php
include "template-parts/pages/page_projects/page_projects.php";
include "template-parts/pages/page_skills/page_skills.php";
get_footer();
?>
</body>

</html>