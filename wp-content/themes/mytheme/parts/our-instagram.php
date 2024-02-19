<?php

function mytheme_our_instagram_custom_section($atts) {
    $atts = shortcode_atts(
        array(
            'url'     => '',
            'text1'   => '',
            'text2'   => '',
            'button'  => '',
            'link'    => '#', //the default link is set to '#'
        ),
        $atts,
        'cta_photo'
    );

    //getting the image URL
    $image_url = esc_url($atts['url']);

    //HTML content
    $output = '
        <div class="our-instagram-div">
            <img src="' . esc_attr($image_url) . '" alt="photo" class="custom-cta-photo">
            <div class="custom-cta-content">
                <p class="our-instagram-text">' . esc_html($atts['text1']) . '</p>
                <p class="follow-our-store">' . esc_html($atts['text2']) . '</p>
                <button class="custom-cta-button" onclick="window.location.href=\'' . esc_url($atts['link']) . '\';">' . esc_html($atts['button']) . '</button>                </div>
        </div>
    ';

    return $output;
}
