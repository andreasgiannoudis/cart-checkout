<?php


//i am changing the breadcrumb separator to a custom vector icon
add_filter('woocommerce_breadcrumb_defaults', 'custom_wc_breadcrumb_defaults');
function custom_wc_breadcrumb_defaults($defaults) {
    $defaults['delimiter'] = ' <span class="separator"><img src="' . get_template_directory_uri() . '/src/images/separator.png" alt="Separator"></span> ';
    return $defaults;
}



//i am removing the coupon field from the checkout page
add_action( 'init', 'remove_coupon_field_checkout' );
function remove_coupon_field_checkout() {
    remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
}

//i am adding the text "Billing Details" to the checkout page
add_action( 'woocommerce_checkout_before_customer_details', 'custom_change_billing_heading' );
function custom_change_billing_heading() {
    echo '<h3 class="billing-details">' . esc_html__( 'Billing Details', 'woocommerce' ) . '</h3>';
}
