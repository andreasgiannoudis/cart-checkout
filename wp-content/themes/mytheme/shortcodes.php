<?php

require_once ("parts/our-instagram.php");
require_once ("parts/store-info.php");
require_once ("parts/custom-form.php");

add_shortcode('our-instagram', 'mytheme_our_instagram_custom_section');
add_shortcode('store_info', 'mytheme_store_info');
add_shortcode('contact_form', 'mytheme_shortcode_contact_form');