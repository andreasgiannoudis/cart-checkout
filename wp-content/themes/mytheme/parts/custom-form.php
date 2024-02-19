<?php

function mytheme_shortcode_contact_form($atts)
{
    $atts = shortcode_atts(
        array(
            "name" => "text",
            "email" => "email",
            "subject" => "text",
            "message" => "textarea",
        ),
        $atts,
        "contact_form"
    );

    $form = '<form method="post" class="contact-us-form">';

    foreach ($atts as $key => $type) {
        $input_type = ($type == 'textarea') ? 'textarea' : 'input';
        $form .= '<label for="' . $key . '">' . ucfirst($key) . '</label>';
        
        if ($input_type === 'textarea') {
            $form .= '<' . $input_type . ' name="' . $key . '" id="' . $key . '"></' . $input_type . '>';
        } else {
            $form .= '<' . $input_type . ' type="' . $type . '" name="' . $key . '" id="' . $key . '">';
        }
    }

    $form .= '<button type="submit" class="send-mail-btn">Submit</button></form>';

    return $form;
}