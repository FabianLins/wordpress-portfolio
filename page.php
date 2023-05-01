<?php
//get_header();
?>
<section class="modal-box-preview">
    <h2>
        <?php the_title() ?>
    </h2>
    <div class="container">
        <?php
            if (have_posts()) {
                while (have_posts()) {
                    the_post();
                    $content = get_the_content();
                    echo $content;
                }
            }
        ?>
    </div>
</section>
<?php
get_footer();
?>
</body>