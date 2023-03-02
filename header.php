<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    wp_head();
    ?>
    <title>Document</title>
</head>

<body>
    <header class="header">
        <div class="banner">
            <div class="name">
                <span class="full-name">Fabian Lins</span>
                <span class="rest">
                    - <span class="title">Full Stack Development</span>
                </span>
            </div>
            <div class="slogan">
                <span class="langs">HTML, (S)CSS, JavaScript, PHP, Media Design </span><span class="more">and much
                    more!</span>
            </div>
            <div class="icon-container">
                <div class="icons">
                    <img src="<?php echo (wp_get_attachment_image_src(26)[0]); ?>" alt="" />
                    <img src="<?php echo (wp_get_attachment_image_src(25)[0]); ?>" alt="" />
                    <img src="<?php echo (wp_get_attachment_image_src(27)[0]); ?>" alt="" />
                    <img src="<?php echo (wp_get_attachment_image_src(28)[0]); ?>" alt="" />
                    <img src="<?php echo (wp_get_attachment_image_src(24)[0]); ?>" alt="" />
                </div>
            </div>
            <img src="<?php header_image(); ?>" class="bg" alt="">
        </div>
    </header>