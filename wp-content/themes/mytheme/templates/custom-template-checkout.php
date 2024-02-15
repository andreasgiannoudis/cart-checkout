<?php
/*
Template Name: Custom Checkout Template
*/
get_header();
$theme_directory = get_template_directory_uri();
?>

<div class="custom-section">
    <div class="photo-overlay">
        
        <!-- PHOTO -->
        <img src="<?php echo $theme_directory; ?>/src/images/custom-photo.jpg" alt="Photo" class="custom-photo">

        <!-- OVERLAY -->
        <div class="overlay"></div>


            <img src="<?php echo $theme_directory; ?>/src/images/logo.png" alt="logo" class="logo-custom">
            <!-- TITLE -->
            <h1 class="page-title"><?php the_title(); ?></h1>

            <!-- BREADCRUMB -->
           <?php woocommerce_breadcrumb(); ?>

      
    </div>
</div>
<!-- WooCommerce Checkout Form -->
<?php echo do_shortcode('[woocommerce_checkout]'); ?>


<?php get_footer(); ?>
