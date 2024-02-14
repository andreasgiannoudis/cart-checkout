<?php

require_once("settings.php");
require_once("shortcodes.php");

function my_theme_enqueue() {
    $theme_directory = get_template_directory_uri();

    wp_enqueue_script('app', $theme_directory . '/resources/scripts/app.js', array(), null, true);

    $data = array(
        "name" => get_option("blogname"),
        "option" => get_option("myoption"),
        'wc_ajax_url' => admin_url( 'admin-ajax.php' ),
    );
    wp_localize_script("app", "myvariables", $data);
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue');




function my_theme_init(){
    $menus = array(
        'huvudmeny' => 'huvudmeny',
        'footer_meny' => 'footer_meny',     
    );

    register_nav_menus($menus);
}
add_action('after_setup_theme', 'my_theme_init');