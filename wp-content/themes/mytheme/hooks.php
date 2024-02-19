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




//i am adding the labels for each input field
add_filter( 'woocommerce_checkout_fields', 'custom_change_checkout_labels' );
function custom_change_checkout_labels( $fields ) {
    $fields['billing']['billing_first_name']['label'] = 'First Name';

    $fields['billing']['billing_last_name']['label'] = 'Last Name';

    $fields['billing']['billing_company']['label'] = 'Company Name';

    $fields['billing']['billing_country']['label'] = 'Country / Region';

    $fields['billing']['billing_address_1']['label'] = 'Street Address';

    $fields['billing']['billing_city']['label'] = 'Town / City';

    $fields['billing']['billing_province']['label'] = 'Province';

    $fields['billing']['billing_postcode']['label'] = 'Zip code';

    $fields['billing']['billing_phone']['label'] = 'Phone';

    $fields['billing']['billing_email']['label'] = 'Email address';

    return $fields;
}


add_filter('woocommerce_checkout_fields', 'custom_checkout_fields');
function custom_checkout_fields($fields) {
    $shipping_countries = WC()->countries->get_shipping_countries();

    if (!empty($shipping_countries)) {
        reset($shipping_countries);
        $default_country = key($shipping_countries);
    } else {
        $default_country = '';
    }

    $fields['billing']['billing_country'] = array(
        'type' => 'select',
        'options' => WC()->countries->get_allowed_countries(),
        'default' => $default_country, 
        'label' => __('Country / Region', 'woocommerce'),
        'required' => true,
        'class' => array('form-row'),
        'autocomplete' => 'country',
    );

    return $fields;
}

//i am removing the placeholderof the street address
add_filter( 'woocommerce_default_address_fields', 'remove_billing_address_placeholder', 10, 1 );
function remove_billing_address_placeholder( $fields ) {
    $fields['address_1']['placeholder'] = '';
    return $fields;
}



//Free shipping is applied automatically when the order amount exceeds the free shipping amount that is set up in WC settings
add_action('woocommerce_cart_calculate_fees', 'apply_free_shipping_based_on_order_amount');
function apply_free_shipping_based_on_order_amount() {
    $free_shipping_settings = get_option('woocommerce_free_shipping_5_settings');
    if (isset($free_shipping_settings['min_amount'])) {
        $minimum_amount_for_free_shipping = floatval($free_shipping_settings['min_amount']);

        if (WC()->cart->subtotal >= $minimum_amount_for_free_shipping) {
            foreach (WC()->shipping()->get_shipping_methods() as $shipping_method_id => $shipping_method) {
                if ($shipping_method_id !== 'free_shipping') {
                    unset(WC()->session->chosen_shipping_methods[$shipping_method_id]);
                    unset(WC()->session->chosen_shipping_methods);
                    WC()->cart->calculate_shipping();
                }
            }
        }
    }
}





add_filter('woocommerce_checkout_fields', 'change_order_notes_placeholder');

function change_order_notes_placeholder($fields) {
    // Check if the order notes field exists
    if (isset($fields['order']['order_comments'])) {
        $fields['order']['order_comments']['label'] = '';
        $fields['order']['order_comments']['placeholder'] = 'Additional information';
        
    }
    return $fields;
}



//Function for the pagination
//set to 12 products per page
function woocommerce_shop_pagination( $query ) {
    if (is_post_type_archive( 'product' )) {
        $query->set( 'posts_per_page', 12 ); //12 is the number of products per page
    }
}
add_action( 'pre_get_posts', 'woocommerce_shop_pagination' );





// HOOKS FOR PRODUCT PAGE
//i am trying to change the order of price and rating by changing the priorities
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price');
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 5 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );





add_action('woocommerce_before_main_content', 'remove_woocommerce_breadcrumb');

function remove_woocommerce_breadcrumb()
{
    //i am removing the breadcrumb only on the shop page
    remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
}


//Custom bredcrumb
add_action('woocommerce_before_main_content', 'custom_product_breadcrumb');
function custom_product_breadcrumb() {
    if (is_product()) {
        echo '<div class="custom-breadcrumb">';
        echo '<a href="' . home_url() . '">Home</a> <span class="separator"><img src="' . get_template_directory_uri() . '/src/images/separator.png" alt="Separator"></span> <a href="' . get_permalink(woocommerce_get_page_id('shop')) . '">Shop</a> <span class="separator"><img src="' . get_template_directory_uri() . '/src/images/separator.png" alt="Separator"></span> <span class="title-breadcrumb">' . get_the_title();  '</span>';
        echo '</div>';
    }
}



remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
//custom hook for star rating 
function my_theme_stars_rating(){
    global $product;
    $rating_count = $product->get_rating_count();
    $rating = $product->get_average_rating();
    $width = ($rating / 5) * 100;

    echo "<div class='rating'><div class='fill' style='width:" . $width . "%'></div></div>";

}
add_action('woocommerce_single_product_summary', 'my_theme_stars_rating', 5);




//hook to change the default sorting to Default
add_filter('woocommerce_catalog_orderby', 'change_default_sorting_text');

function change_default_sorting_text($orderby_options) {
    $orderby_options['menu_order'] = __('Default', 'woocommerce');
    return $orderby_options;
}