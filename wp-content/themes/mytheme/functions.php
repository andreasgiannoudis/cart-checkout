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





//FUNCTIONALITY TO ADD TO CART 
//WORKS WITH SINGLE PRODUCTS
add_action( 'wp_footer', 'single_product_ajax_add_to_cart_js_script' );
function single_product_ajax_add_to_cart_js_script() {
    ?>
    <script>
    (function($) {
        $('form.cart').on('submit', function(e) {
            e.preventDefault();

            var form   = $(this),
                mainId = form.find('.single_add_to_cart_button').val(),
                fData  = form.serializeArray();

            form.block({ message: null, overlayCSS: { background: '#fff', opacity: 0.6 } });

            if ( mainId === '' ) {
                mainId = form.find('input[name="product_id"]').val();
            }

            if ( typeof wc_add_to_cart_params === 'undefined' )
                return false;

            $.ajax({
                type: 'POST',
                url: wc_add_to_cart_params.wc_ajax_url.toString().replace( '%%endpoint%%', 'custom_add_to_cart' ),
                data : {
                    'product_id': mainId,
                    'form_data' : fData
                },
                success: function (response) {
                    $(document.body).trigger("wc_fragment_refresh");
                    $('.woocommerce-error,.woocommerce-message').remove();
                    $('input[name="quantity"]').val(1);
                    $('.content-area').before(response);
                    form.unblock();

                },
                error: function (error) {
                    form.unblock();
                }
            });
        });
    })(jQuery);
    </script>
    <?php
}

add_action( 'wc_ajax_custom_add_to_cart', 'custom_add_to_cart_handler' );
add_action( 'wc_ajax_nopriv_custom_add_to_cart', 'custom_add_to_cart_handler' );
function custom_add_to_cart_handler() {
    if( isset($_POST['product_id']) && isset($_POST['form_data']) ) {
        $product_id = $_POST['product_id'];

        $variation = $cart_item_data = $custom_data = array();
        $variation_id = 0;

        foreach( $_POST['form_data'] as $values ) {
            if ( strpos( $values['name'], 'attributes_' ) !== false ) {
                $variation[$values['name']] = $values['value'];
            } elseif ( $values['name'] === 'quantity' ) {
                $quantity = $values['value'];
            } elseif ( $values['name'] === 'variation_id' ) {
                $variation_id = $values['value'];
            } elseif ( $values['name'] !== 'add_to_cart' ) {
                $custom_data[$values['name']] = esc_attr($values['value']);
            }
        }

        $product = wc_get_product( $variation_id ? $variation_id : $product_id );

        $cart_item_data = (array) apply_filters( 'woocommerce_add_cart_item_data', $cart_item_data, $product_id, $variation_id, $quantity, $custom_data );

        $cart_item_key = WC()->cart->add_to_cart( $product_id, $quantity, $variation_id, $variation, $cart_item_data );

        if ( $cart_item_key ) {
            wc_add_notice( sprintf(
                '<a href="%s" class="button wc-forward">%s</a> %d &times; "%s" %s' ,
                wc_get_cart_url(),
                __("View cart", "woocommerce"),
                $quantity,
                $product->get_name(),
                __("has been added to your cart", "woocommerce")
            ) );
        }

        wc_print_notices();
        wp_die();
    }
}
