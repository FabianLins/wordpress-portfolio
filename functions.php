<?php

function lins_theme_support()
{
    add_theme_support('title-tag');
}

add_action('after_setup_theme', 'lins_theme_support');

function lins_register_styles()
{
    $version = wp_get_theme()->get('Version');
    wp_enqueue_style('lins-css', get_template_directory_uri() . "/style.css", array(), $version, 'all');
}

add_action('wp_enqueue_scripts', 'lins_register_styles');

function lins_register_scripts()
{
    wp_enqueue_script('lins-js', 'path/script.js', array(), '1.0', true);
}


add_action('wp_enqueue_scripts', 'lins_register_scripts');

?>