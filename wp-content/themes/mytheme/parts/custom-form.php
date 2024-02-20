<?php

function mytheme_shortcode_contact_form($atts)
{
    $atts = shortcode_atts(
        array(
            "name_label" => "Name",
            "email_label" => "Email",
            "subject_label" => "Subject",
            "message_label" => "Message",
            "name_placeholder" => "",
            "email_placeholder" => "",
            "subject_placeholder" => "",
            "message_placeholder" => "",
        ),
        $atts,
        "contact_form"
    );

    $form = '<form method="post" class="contact-us-form">';

    $label_placeholder_atts = array(
        "name_label" => "name_placeholder",
        "email_label" => "email_placeholder",
        "subject_label" => "subject_placeholder",
        "message_label" => "message_placeholder",
    );

    foreach ($label_placeholder_atts as $label_key => $placeholder_key) {
        $label = isset($atts[$label_key]) ? $atts[$label_key] : ucfirst(str_replace("_label", "", $label_key));
        $placeholder = isset($atts[$placeholder_key]) ? $atts[$placeholder_key] : "";
        $form .= '<label for="' . $label_key . '">' . $label . '</label>';
        $form .= '<input type="text" name="' . $label_key . '" id="' . $label_key . '" placeholder="' . $placeholder . '">';
    }

    $form .= '<button type="submit" class="send-mail-btn">Submit</button></form>';

    return $form;
}

