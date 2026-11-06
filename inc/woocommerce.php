<?php
/**
 * WooCommerce integration.
 *
 * @package FaunaDelVelazco
 */

defined( 'ABSPATH' ) || exit;

/**
 * Declare compatibility with WooCommerce features.
 */
function fv_declare_woocommerce_compatibility(): void {
	if ( ! class_exists( '\Automattic\WooCommerce\Utilities\FeaturesUtil' ) ) {
		return;
	}

	\Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', FV_DIR . '/functions.php', true );
	\Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'cart_checkout_blocks', FV_DIR . '/functions.php', true );
}
add_action( 'before_woocommerce_init', 'fv_declare_woocommerce_compatibility' );

/**
 * Replace WooCommerce's default content wrappers with theme wrappers.
 */
function fv_woocommerce_layout(): void {
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar' );

	add_action( 'woocommerce_before_main_content', 'fv_woocommerce_wrapper_start', 10 );
	add_action( 'woocommerce_after_main_content', 'fv_woocommerce_wrapper_end', 10 );
}
add_action( 'init', 'fv_woocommerce_layout', 20 );

/**
 * Open the WooCommerce content wrapper.
 */
function fv_woocommerce_wrapper_start(): void {
	echo '<main id="primary" class="fv-main fv-woocommerce-main"><div class="fv-container py-12">';
}

/**
 * Close the WooCommerce content wrapper.
 */
function fv_woocommerce_wrapper_end(): void {
	echo '</div></main>';
}
