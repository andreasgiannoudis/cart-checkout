<?php

if(!defined('ABSPATH')){
    exit;
}

require_once("vite.php");


require_once(get_template_directory() . "/init.php");





//i am adding this to support woocommerce on my theme
function mytheme_add_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );




//i am changing the breadcrumb separator to a custom vector icon
add_filter('woocommerce_breadcrumb_defaults', 'custom_wc_breadcrumb_defaults');
function custom_wc_breadcrumb_defaults($defaults) {
    $defaults['delimiter'] = ' <span class="separator"><img src="' . get_template_directory_uri() . '/src/images/separator.png" alt="Separator"></span> ';
    return $defaults;
}

