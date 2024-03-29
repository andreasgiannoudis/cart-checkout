<?php
/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 * @global WC_Checkout $checkout
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="woocommerce-billing-fields">
    <?php if ( wc_ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>
        <h3><?php esc_html_e( 'Billing &amp; Shipping', 'woocommerce' ); ?></h3>
    <?php else : ?>
        <h3><?php esc_html_e( 'Billing details', 'woocommerce' ); ?></h3>
    <?php endif; ?>

    <?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>

    <div class="woocommerce-billing-fields__field-wrapper">
        <?php
        $fields = $checkout->get_checkout_fields();

        $field_order = array(
            'billing_first_name',
            'billing_last_name',
            'billing_company',
            'billing_country',
            'billing_address_1',
			'billing_city',
            'billing_province',
			'billing_postcode',
            'billing_phone',
            'billing_email',
        );

        foreach ( $field_order as $field_key ) {
            if ( isset( $fields['billing'][$field_key] ) ) {
                woocommerce_form_field( $field_key, $fields['billing'][$field_key], $checkout->get_value( $field_key ) );
            }
        }
        ?>
    </div>

    <?php do_action( 'woocommerce_after_checkout_billing_form', $checkout ); ?>
</div>




<?php if ( ! is_user_logged_in() && $checkout->is_registration_enabled() ) : ?>
	<div class="woocommerce-account-fields">
		<?php if ( ! $checkout->is_registration_required() ) : ?>

			<p class="form-row form-row-wide create-account">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true ); ?> type="checkbox" name="createaccount" value="1" /> <span><?php esc_html_e( 'Create an account?', 'woocommerce' ); ?></span>
				</label>
			</p>

		<?php endif; ?>

		<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

		<?php if ( $checkout->get_checkout_fields( 'account' ) ) : ?>

			<div class="create-account">
				<?php foreach ( $checkout->get_checkout_fields( 'account' ) as $key => $field ) : ?>
					<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
				<?php endforeach; ?>
				<div class="clear"></div>
			</div>

		<?php endif; ?>

		<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>
	</div>
<?php endif; ?>
