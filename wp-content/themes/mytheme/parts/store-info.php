<?php

function mytheme_store_info($atts) {
    
    // HTML content
    $output = '
        <div class="store-info-contact">
            <p class="store-address">Address</p>
            ' .get_option('woocommerce_store_address') . '<br>' .
            get_option('woocommerce_store_city') . ',<br>' . 
            get_option('woocommerce_store_postcode') . ' ' . 
            get_option('woocommerce_default_country') . '
        </div>

        <div class="store-info-phone">
            <p class="store-phone">Phone</p>
            <span class="store-mobile"> ' . get_option('company_mobile') . '</span>
            <span class="store-hotline">' . get_option('company_hotline') . '</span>
            
        </div>

        <div class="store-info-openhours">
            <p class="store-opening-hours">Working Time</p>
            <p class="store-weekdays"> <span>Monday-Friday: '. get_option('company_openHour_weekday') .' - '. get_option('company_closeHour_weekday') . '</span> </p>
            <p class="store-weekends"> <span>Monday-Friday: '. get_option('company_openHour_weekend') .' - '. get_option('company_closeHour_weekend') . '</span> </p>

        </div>
    ';

    return $output;
}
?>
