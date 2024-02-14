<html>
    <head>
        <title><?= get_option("blogname");?></title>
        <?php wp_head();?>
    </head>
    <body>
        <?php wp_body_open();?>
        <?php if (!empty(get_option('store_message'))) : ?>
            <div class="site-message">
                <span><?= get_option('store_message'); ?> </span>
            </div>
            <?php endif; ?>
        <header>
            <div class="column-50">
               
            </div>
            <div class="column-50">
                <?php

                $menu_header = array(
                    'theme_location' => 'huvudmeny',
                    'menu_id' => 'header-menu',
                    'container' => 'nav',
                    'container_class' => 'menu'
                );
                wp_nav_menu($menu_header);
                ?>
            </div>
            <div class="column-50 login-shopping-bag">
                <?php

                $menu_header = array(
                    'theme_location' => 'huvudmeny2',
                    'menu_id' => 'header-menu',
                    'container' => 'nav',
                    'container_class' => 'menu'
                );
                wp_nav_menu($menu_header);
                ?>
            </div>
        </header>
