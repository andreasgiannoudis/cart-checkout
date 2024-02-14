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
    <div class="footer-container">
    <div class="footer-left">
        <div class="store-info">

            <p>
                <?php echo get_bloginfo('name'); ?>
                <?php echo get_option('woocommerce_store_city') . "," ?> <br>
                <?php echo get_option('woocommerce_store_postcode'); ?>
                <?php echo get_option('woocommerce_default_country'); ?>

            </p>



        </div>


    </div>
    <div class="footer-center1">
        <?php
        echo "<div class='footerheader1'>Links</div>";

        $menu_header = array(
            'theme_location' => 'huvudmeny',
            'menu_id' => 'header-menu',
            'container' => 'nav',
            'container_class' => 'menu'
        );
        wp_nav_menu($menu_header);
        ?>



        </div>

    <div class="footer-center2">
        <?php


        echo "<div class='footerheader2'>Help</div>";
        $menu_header = array(
            'theme_location' => 'footer_meny',
            'menu_id' => 'footer-menu',
            'container' => 'nav',
            'container_class' => 'menu'
        );
        wp_nav_menu($menu_header);
        ?>

    </div>
    <div class="footer-right">
        <div class="footerheader3">Newsletter</div>
        <div class="footer-form">
            <input type="text">
            <button>Subscribe</button>
        </div>

    </div>



    </div>
   
   

    <div class="copyright"><?= date('Y') . " " .   get_bloginfo('name')  ?>. All rights reserved.</div>

</footer>
<?php wp_footer(); ?>
</body>

</html>