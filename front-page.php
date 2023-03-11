<?php
get_header();
?>
<input type="checkbox" name="list-of-skills" id="list-of-skills">
<div class="about-me-container">
    <section class="about-me">
        <h2 class="h2 mt-header h-pl animation-slide-in-right">
            <?php the_title() ?>
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
                        <img src="/wp-content/themes/custom-theme/img/lucico.jpg" alt="">
                    </div>
                    <div class="buttons">
                        <a class="btn-1" href="#anchor">
                            <label for="list-of-skills" class="prim-btn big animation-button-blink">
                                <?php echo get_the_title('22'); ?>
                            </label>
                        </a>
                        <div class="btn-2">
                            <a href="<?php echo (get_permalink('18')); ?>"
                                class="prim-btn big animation-button-blink animation-delay">
                                <?php echo get_the_title('18'); ?>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="right">
                    <div class="photo animation-slide-in-left animation-spin-in">
                        <img src="/wp-content/themes/custom-theme/img/lucico.jpg" alt="">
                    </div>
                </div>

            </div>


        </div>
        <img class="wheel-icon animation-spin" src="<?php echo (wp_get_attachment_image_src(35)[0]); ?>" alt="" />
    </section>
    <div id="anchor"></div>
    <section class="list-of-skills">
        lol
    </section>
</div>

<?php
get_footer();
?>
</body>

</html>