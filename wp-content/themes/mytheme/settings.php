<?php

if(!is_admin()) {
    return;
}

//lägger till et menyalternativ "Butik" i dashboard udner settings
function mytheme_add_settings() {
    add_submenu_page(
        "options-general.php",
        "Butik",
        "Butik",
        "edit_pages",
        "butik",
        "mytheme_add_settings_callback"
    );
}

function mytheme_add_settings_callback(){
    ?>

    <div class="wrap">
        <h2>Store information</h2>
        <form action="options.php" method="post">
            <?php
            settings_fields('butik');
            do_settings_sections('butik');
            submit_button();
            ?>
        </form>
    </div>

    <?php
}

add_action('admin_menu', 'mytheme_add_settings');

//registrerar inställningar tillgängliga på sidan "Butik"
function mytheme_add_settings_init(){
    add_settings_section(
        'butik_general',
        'General',
        'mytheme_add_settings_section_general',
        'butik'
    );

    //register store message
    register_setting(
        'butik',
        'store_message'
    );

    add_settings_field(
        'store_message',
        'Store Message',
        'mytheme_section_general_setting',
        'butik',
        'butik_general',
        array(
            "option_name" => "store_message",
            "option_type" => "text"
        )
    );

   
}

add_action('admin_init', 'mytheme_add_settings_init');


//ritar ut inställningar på sidan "Butik"
function mytheme_add_settings_section_general(){
    echo"<p>Generella inställningar för butiken</p>";
}

//ritar ut inställningsfältet för store_message
function mytheme_section_general_setting($args){
    $option_name = $args["option_name"];
    $option_type = $args["option_type"];
    $option_value = get_option($args["option_name"]);
    echo '<input type="'. $option_type .'" id="' . $option_name . '" name="'. $option_name .'" value="' . $option_value . '" />';
}