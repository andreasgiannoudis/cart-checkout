<?php

require_once("settings.php");
require_once("shortcodes.php");

function my_theme_enqueue() {    
    $data = array(
        "name" => get_option("blogname"),
        "option" => get_option("myoption"),
    );
    wp_localize_script("app", "myvariables", $data);
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue');

function enqueue_custom_scripts() {
    // Enqueue your custom script
    wp_enqueue_script('custom-script', get_template_directory_uri() . '/resources/js/ajax-add-to-cart.js', array('jquery'), null, true);

    // Localize the admin-ajax.php URL for use in JavaScript
    wp_localize_script('custom-script', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');



function my_theme_init(){
    $menus = array(
        'huvudmeny' => 'huvudmeny',
        'menyikoner'=>'menyikoner',
        'footer_meny' => 'footer_meny',
     
    );

    register_nav_menus($menus);
}
add_action('after_setup_theme', 'my_theme_init');