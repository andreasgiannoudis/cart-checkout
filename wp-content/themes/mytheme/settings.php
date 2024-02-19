<?php

if(!is_admin()) {
    return;
}

//lägger till et menyalternativ "Butik" i dashboard udner settings
function mytheme_add_settings() {
    add_submenu_page(
        "options-general.php",
        "Store Settings",
        "Store Settings",
        "edit_pages",
        "store",
        "mytheme_add_settings_callback"
    );
}

function mytheme_add_settings_callback(){
    ?>

    <div class="wrap">
        <h2>Company settings</h2>
        <form action="options.php" method="post">
            <?php
            settings_fields('store');
            do_settings_sections('store');
            submit_button();
            ?>
        </form>
    </div>

    <?php
}

add_action('admin_menu', 'mytheme_add_settings');

function mytheme_add_settings_init(){
    add_settings_section(
        'store_general',
        'General',
        'mytheme_add_settings_section_general',
        'store'
    );


    register_setting(
        'store',
        'company_mobile'
    );
    add_settings_field(
        'company_mobile',
        'Mobile phone',
        'mytheme_section_general_setting',
        'store',
        'store_general',
        array(
            "option_name" => "company_mobile",
            "option_type" => "text"
        )
    );

    register_setting(
        'store',
        'company_hotline'
    );
    add_settings_field(
        'company_hotline',
        'Hotline',
        'mytheme_section_general_setting',
        'store',
        'store_general',
        array(
            "option_name" => "company_hotline",
            "option_type" => "text"
        )
    );

    register_setting(
        'store',
        'company_openHour_weekday'
    );
    add_settings_field(
        'company_openHour_weekday',
        'Weekday Open time',
        'mytheme_section_general_setting',
        'store',
        'store_general',
        array(
            "option_name" => "company_openHour_weekday",
            "option_type" => "time"
        )
    );

    register_setting(
        'store',
        'company_closeHour_weekday'
    );
    add_settings_field(
        'company_closeHour_weekday',
        'Weekday Close time',
        'mytheme_section_general_setting',
        'store',
        'store_general',
        array(
            "option_name" => "company_closeHour_weekday",
            "option_type" => "time"
        )
    );


    register_setting(
        'store',
        'company_openHour_weekend'
    );
    add_settings_field(
        'company_openHour_weekend',
        'Weekend Open time',
        'mytheme_section_general_setting',
        'store',
        'store_general',
        array(
            "option_name" => "company_openHour_weekend",
            "option_type" => "time"
        )
    );

    register_setting(
        'store',
        'company_closeHour_weekend'
    );
    add_settings_field(
        'company_closeHour_weekend',
        'Weekend Close time',
        'mytheme_section_general_setting',
        'store',
        'store_general',
        array(
            "option_name" => "company_closeHour_weekend",
            "option_type" => "time"
        )
    );

    
}

add_action('admin_init', 'mytheme_add_settings_init');


function mytheme_add_settings_section_general(){
    echo"<p>General settings for your company</p>";
}

function mytheme_section_general_setting($args){
    $option_name = $args["option_name"];
    $option_type = $args["option_type"];
    $option_value = get_option($args["option_name"]);
    echo '<input type="'. $option_type .'" id="' . $option_name . '" name="'. $option_name .'" value="' . $option_value . '" />';
}