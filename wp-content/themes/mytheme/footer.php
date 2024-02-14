<footer>
    <div class="footer-left">
    </div>

    <div class="footer-center">
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

    <div class="footer-right">
        <?php



        $menu_header = array(
            'theme_location' => 'footer_meny',
            'menu_id' => 'footer-menu',
            'container' => 'nav',
            'container_class' => 'menu'
        );
        wp_nav_menu($menu_header);
        ?>

    </div>
    <div class="copyright">© Copyright <?= get_bloginfo('name') . " " .  date('Y'); ?></div>

</footer>

</body>

</html>