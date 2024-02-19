<?php
/*
Template Name: Custom General Template
*/

get_header();

$hero_photo_url = 'https://cart-checkout.test/wp-content/uploads/2024/02/hero-photo-scaled.jpg';



?>

<div class="custom-section">
    <div class="photo-overlay">

        <!-- PHOTO -->
        <?php if (!empty($hero_photo_url)) : ?>
            <img src="<?php echo esc_url($hero_photo_url); ?>" alt="Photo" class="custom-photo">
        <?php endif; ?>

        <!-- OVERLAY -->
        <div class="overlay"></div>

        <img src="<?php echo get_template_directory_uri(); ?>/src/images/logo.png" alt="logo" class="logo-custom">
        <!-- TITLE -->
        <h1 class="page-title"><?php the_title(); ?></h1>

        <!-- BREADCRUMB -->
        <?php woocommerce_breadcrumb(); ?>

    </div>
</div>

<div class="page-content">
    <?php
    the_content();

    ?>
</div>

<?php

//Output content based on the page being displayed.
if (is_page('checkout')) {
    echo do_shortcode('[woocommerce_checkout]');
} elseif (is_page('cart')) {
    echo do_shortcode('[woocommerce_cart]');
}
?>
<div class="footer-box">
        <div class="footer-box1">
            <div class="footer-box1-text">
                <h3>Free Delivery</h3>
                <p>For all oders over $50, consectetur adipim scing elit.</p>

            </div>


        </div>
        <div class="footer-box2">
            <div class="footer-box2-text">
                <h3>90 Days Return</h3>
                <p>If goods have problems, consectetur adipim scing elit.</p>

            </div>


        </div>
        <div class="footer-box3">
            <div class="footer-box3-text">
                <h3>Secure Payment</h3>
                <p>100% secure payment, consectetur adipim scing elit.</p>

            </div>


        </div>
    </div>
<?php get_footer(); ?>