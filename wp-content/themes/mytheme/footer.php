<footer>
    <div class="footer-box">
        <div class="footer-box1">
            <h3>Free Delivery</h3>
            <p>For all oders over $50, consectetur adipim scing elit.</p>

        </div>
        <div class="footer-box2">
            <h3>90 Days Return</h3>
            <p>If goods have problems, consectetur adipim scing elit.</p>

        </div>
        <div class="footer-box3">
            <h3>Secure Payment</h3>
            <p>100% secure payment, consectetur adipim scing elit.</p>

        </div>
    </div>
    <div class="footer-left">
    </div>

    <div class="footer-center">
        <div class="store-info">
        
        <p>
             <?php echo get_bloginfo('name'); ?>
            <?php echo get_option('woocommerce_store_city') . "," ?> <br>
            <?php echo get_option('woocommerce_store_postcode'); ?>
            <?php echo get_option('woocommerce_default_country'); ?>

        </p>



        </div>
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

    <div class="copyright"><?= date('Y') . " " .   get_bloginfo('name')  ?>. All rights reserved.</div>

</footer>
<?php wp_footer(); ?>
</body>

</html>