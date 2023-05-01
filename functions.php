<?php
function lins_theme_support()
{
    add_theme_support("title-tag");
    add_theme_support("post-thumbnails");
    $args = array(
        "flex-width" => true,
        "width" => 1500,
        "flex-height" => true,
        "height" => 420,
        "default-image" => get_template_directory_uri() . "/img/header.jpg",
    );
    add_theme_support("custom-header", $args);

}

add_action("after_setup_theme", "lins_theme_support");

function lins_register_styles()
{
    $version = wp_get_theme()->get('Version');
    wp_enqueue_style("lins-css", get_template_directory_uri() . "/style.min.css", array(), $version, "all");
}

add_action("wp_enqueue_scripts", "lins_register_styles");

function lins_register_scripts()
{
    wp_enqueue_script("lins-js", get_template_directory_uri() . "/script.js", array(), "1.0", true);
}

add_action("wp_enqueue_scripts", "lins_register_scripts");

?>