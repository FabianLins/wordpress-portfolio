<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    wp_head();
    ?>
</head>
<?php
$src = get_template_directory_uri() . "/svg/arrow.svg";
?>

<body id="href-top" class="body no-js js-sections">
    <a href="#href-top" class="scroll-arrow js-scroll-top">
        <?php echo file_get_contents($src); ?>
    </a>
    <div class="scroll-bottom-fade animation-scroll-bottom-fade">
    </div>
    <header class="header">
        <div class="banner">
            <div class="name animation-blur-in">
                <span class="full-name">Fabian Lins</span>
                <span class="rest">
                    - <span class="title">Full Stack Development</span>
                </span>
            </div>
            <div class="slogan animation-fade-blur-in">
                <span class="langs">HTML, (S)CSS, JavaScript, PHP, Media Design </span><span class="more">and much
                    more!</span>
            </div>
            <div class="icon-container">
                <div class="icons animation-zoom-in">
                    <img class="animation-jump" src="<?php echo (get_template_directory_uri() . "/svg/html.svg"); ?>"
                        alt="" />
                    <img class="animation-jump animation-delay-1"
                        src="<?php echo (get_template_directory_uri() . "/svg/css.svg"); ?>" alt="" />
                    <img class="animation-jump animation-delay-2"
                        src="<?php echo (get_template_directory_uri() . "/svg/js.svg"); ?>" alt="" />
                    <img class="animation-jump animation-delay-3"
                        src="<?php echo (get_template_directory_uri() . "/svg/php.svg"); ?>" alt="" />
                    <img class="animation-jump animation-delay-4"
                        src="<?php echo (get_template_directory_uri() . "/svg/adobe-cc.svg"); ?>" alt="" />
                </div>
            </div>
            <img src="<?php header_image(); ?>" class="bg" alt="">
        </div>
    </header>