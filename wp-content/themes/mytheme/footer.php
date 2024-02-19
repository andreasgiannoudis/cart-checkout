<footer>
    <div class="footer-wrapper"></div>
    
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
                <input type="text" placeholder="Enter Your Email Address">
                <button>Subscribe</button>
            </div>

        </div>




    </div>
    <div class="linje">
        <div></div>
    </div>

    <div class="copyright"><?= date('Y') . " " .   get_bloginfo('name')  ?>. All rights reserved.</div>

</footer>
<?php wp_footer(); ?>
</body>

</html>