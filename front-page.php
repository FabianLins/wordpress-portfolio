<?php
get_header();
?>
<section class="about-me">
    <h2 class="h2 mt-header h-pl">
        <?php the_title() ?>
    </h2>
    <div class="container">
        <div class="grid">
            <div class="left">
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
                <div class="buttons">
                    <div class="btn-1">
                        <a href="#" class="prim-btn big">
                            List of skills
                        </a>
                    </div>
                    <div class="btn-2">
                        <a href="#" class="prim-btn big">
                            Projects
                        </a>
                    </div>
                </div>
            </div>
            <div class="right">
                <div class="photo">
                    <img src="/wp-content/themes/custom-theme/img/lucico.jpg" alt="">
                </div>
            </div>

        </div>


    </div>
    <div class="bot-fade"></div>
</section>
<?php
get_footer();
?>
</body>

</html>