<?php

if(!defined('ABSPATH')){
    exit;
}

require_once("vite.php");
require_once("hooks.php");


require_once(get_template_directory() . "/init.php");

//i am adding this to support woocommerce on my theme
function mytheme_add_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );




add_action('wp_ajax_add_to_cart', 'add_to_cart_ajax');
add_action('wp_ajax_nopriv_add_to_cart', 'add_to_cart_ajax');

function add_to_cart_ajax() {
    if (isset($_POST['product_id'])) {
        $product_id = absint($_POST['product_id']);
        $quantity = isset($_POST['quantity']) ? absint($_POST['quantity']) : 1;
        WC()->cart->add_to_cart($product_id, $quantity);
        echo 'Product added to cart';
    } else {
        echo 'Error: Product ID not provided';
    }
    wp_die();
}

