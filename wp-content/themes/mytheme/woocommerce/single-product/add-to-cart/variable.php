<?php

/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 6.1.0
 */

defined('ABSPATH') || exit;

global $product;


$attribute_keys  = array_keys($attributes);
$variations_json = wp_json_encode($available_variations);
$variations_attr = function_exists('wc_esc_json') ? wc_esc_json($variations_json) : _wp_specialchars($variations_json, ENT_QUOTES, 'UTF-8', true);

do_action('woocommerce_before_add_to_cart_form'); ?>

<form id="form" class="variations_form cart" action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint($product->get_id()); ?>" data-product_variations="<?php echo esc_attr(json_encode($product->get_available_variations())); ?>">

    <?php if (empty($available_variations) && false !== $available_variations) : ?>
        <p class="stock out-of-stock"><?php echo esc_html(apply_filters('woocommerce_out_of_stock_message', __('This product is currently out of stock and unavailable.', 'woocommerce'))); ?></p>
    <?php else : ?>
        <table class="variations" cellspacing="0" role="presentation">
            <tbody>
                <?php foreach ($attributes as $attribute_name => $options) : ?>
                    <tr>
                        <td class="value">
                            <div class="attribute-options">
                                <?php if ($attribute_name === 'Size') : ?>
                                    <div class="select-values-div">
                                        <span class="select-values"> <?= wc_attribute_label($attribute_name); ?> <span id="value-of-the-option-size" class="value-of-the-option-size"></span></span>
                                    </div>
                                    <?php foreach ($options as $option) : ?>

                                        <button class="attribute-option" data-value="<?= esc_attr($option); ?>">
                                            <span class="size"><?= esc_html($option); ?></span>
                                        </button>
                                        <input type="hidden" name="attribute_pa_size" value="">
                                    <?php endforeach; ?>
                                <?php elseif ($attribute_name === 'Color') : ?>
                                    <span class="select-values"><?= wc_attribute_label($attribute_name); ?> <span id="value-of-the-option-color" class="value-of-the-option-color"></span></span>
                                    <div class="attribute-options">
                                        <?php foreach ($options as $option) : ?>
                                            <?php
                                            $color = '';
                                            switch ($option) {
                                                case 'Blue':
                                                    $color = '#816DFA';
                                                    break;
                                                case 'Black':
                                                    $color = 'black';
                                                    break;
                                                case 'Beige':
                                                    $color = '#CDBA7B';
                                                    break;
                                            }
                                            ?>
                                            <button class="attribute-option color-values" data-value="<?php echo esc_attr($option); ?>" style="background: <?php echo esc_attr($color); ?>;"></button>
											<input type="hidden" name="attribute_pa_color" value="">
                                        <?php endforeach; ?>
                                    </div>
									<div id="confirmation-message"></div>

                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>


        <?php do_action('woocommerce_after_variations_table'); ?>

        <div class="single_variation_wrap">
            <?php
            /**
             * Hook: woocommerce_before_single_variation.
             */
            do_action('woocommerce_before_single_variation');

            /**
             * Hook: woocommerce_single_variation. Used to output the cart button and placeholder for variation data.
             *
             * @since 2.4.0
             * @hooked woocommerce_single_variation - 10 Empty div for variation data.
             * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
             */
            do_action('woocommerce_single_variation');

            /**
             * Hook: woocommerce_after_single_variation.
             */
            do_action('woocommerce_after_single_variation');
            ?>
        </div>
    <?php endif; ?>
    
    <input type="hidden" name="variation_id" value="">
	<input type="hidden" name="quantity" value="1">


    <?php do_action('woocommerce_after_variations_form'); ?>
</form>


<?php
do_action('woocommerce_after_add_to_cart_form');
