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

/**
 * Resolve a Media URL to an attachment ID.
 *
 * The catalog stores the URL that the clinic copies from the Media library.
 * WooCommerce needs an attachment ID, so the URL is converted here and cached
 * for the duration of the request.
 *
 * @param string $url Attachment file URL.
 * @return int
 */
function fv_attachment_id_desde_url( string $url ): int {
	static $cache = array();

	$url = trim( $url );

	if ( '' === $url ) {
		return 0;
	}

	if ( isset( $cache[ $url ] ) ) {
		return $cache[ $url ];
	}

	$clean_url = (string) strtok( $url, '?' );
	$attachment_id = (int) attachment_url_to_postid( $clean_url );

	if ( ! $attachment_id ) {
		$without_size = preg_replace( '/-\d+x\d+(?=\.[a-z0-9]+$)/i', '', $clean_url );
		if ( is_string( $without_size ) && $without_size !== $clean_url ) {
			$attachment_id = (int) attachment_url_to_postid( $without_size );
		}
	}

	$cache[ $url ] = $attachment_id;

	return $attachment_id;
}

/**
 * Get the image URL configured in the catalog for a SKU.
 *
 * @param string $sku Product SKU.
 * @return string
 */
function fv_url_imagen_catalogo( string $sku ): string {
	$item = fv_catalogo_producto_por_sku( $sku );

	return isset( $item['imagen'] ) ? trim( (string) $item['imagen'] ) : '';
}

/**
 * Get the best available image URL for a product.
 *
 * Priority: catalog URL, featured image, empty string.
 *
 * @param int $producto_id Product ID.
 * @return string
 */
function fv_url_imagen_producto( int $producto_id ): string {
	if ( ! function_exists( 'wc_get_product' ) ) {
		return '';
	}

	$producto = wc_get_product( $producto_id );

	if ( ! $producto ) {
		return '';
	}

	$url = fv_url_imagen_catalogo( $producto->get_sku() );

	if ( '' !== $url ) {
		return $url;
	}

	$image_id = (int) $producto->get_image_id();

	if ( $image_id ) {
		$image_url = wp_get_attachment_image_url( $image_id, 'full' );

		return $image_url ? (string) $image_url : '';
	}

	return '';
}

/**
 * Build the product image HTML using the catalog URL or the featured image.
 *
 * @param int                  $producto_id Product ID.
 * @param string               $size        Image size.
 * @param array<string, mixed> $attr        Extra image attributes.
 * @return string
 */
function fv_imagen_producto_html( int $producto_id, string $size = 'fv-card', array $attr = array() ): string {
	if ( ! function_exists( 'wc_get_product' ) ) {
		return '';
	}

	$producto = wc_get_product( $producto_id );

	if ( ! $producto ) {
		return '';
	}

	$url = fv_url_imagen_catalogo( $producto->get_sku() );

	if ( '' !== $url ) {
		$attachment_id = fv_attachment_id_desde_url( $url );

		if ( $attachment_id ) {
			return (string) wp_get_attachment_image( $attachment_id, $size, false, $attr );
		}

		$attr = wp_parse_args(
			$attr,
			array(
				'alt'     => $producto->get_name(),
				'loading' => 'lazy',
			)
		);

		$attr['src'] = $url;
		$attr['alt'] = isset( $attr['alt'] ) && '' !== $attr['alt'] ? $attr['alt'] : $producto->get_name();

		$html = '<img';

		foreach ( $attr as $key => $value ) {
			if ( is_scalar( $value ) ) {
				$html .= ' ' . esc_attr( (string) $key ) . '="' . esc_attr( (string) $value ) . '"';
			}
		}

		return $html . ' />';
	}

	$image_id = (int) $producto->get_image_id();

	if ( $image_id ) {
		return (string) wp_get_attachment_image( $image_id, $size, false, $attr );
	}

	return '';
}

/**
 * Use the catalog image as the native WooCommerce image when possible.
 *
 * This makes the image available in the shop, single product, cart, checkout
 * and emails because WooCommerce receives a real attachment ID.
 *
 * @param int        $image_id Image ID.
 * @param WC_Product $product  Product object.
 * @return int
 */
function fv_filtrar_imagen_producto_id( $image_id, $product ) {
	if ( ! $product instanceof WC_Product ) {
		return $image_id;
	}

	$url = fv_url_imagen_catalogo( $product->get_sku() );

	if ( '' === $url ) {
		return $image_id;
	}

	$attachment_id = fv_attachment_id_desde_url( $url );

	return $attachment_id ? $attachment_id : $image_id;
}
add_filter( 'woocommerce_product_get_image_id', 'fv_filtrar_imagen_producto_id', 10, 2 );

/**
 * Fallback for catalog URLs that are not in the Media library.
 *
 * @param string     $image       Image HTML.
 * @param WC_Product $product     Product object.
 * @param string     $size        Image size.
 * @param array      $attr        Image attributes.
 * @param bool       $placeholder Whether to show a placeholder.
 * @param string     $original    Original image HTML.
 * @return string
 */
function fv_filtrar_imagen_producto_html( $image, $product, $size, $attr, $placeholder, $original ) {
	if ( ! $product instanceof WC_Product ) {
		return $image;
	}

	$url = fv_url_imagen_catalogo( $product->get_sku() );

	if ( '' === $url || fv_attachment_id_desde_url( $url ) ) {
		return $image;
	}

	$attr = wp_parse_args(
		is_array( $attr ) ? $attr : array(),
		array(
			'alt'   => $product->get_name(),
			'class' => 'attachment-' . $size . ' size-' . $size . ' wp-post-image',
		)
	);

	$attr['src'] = $url;
	$attr['alt'] = isset( $attr['alt'] ) && '' !== $attr['alt'] ? $attr['alt'] : $product->get_name();

	$html = '<img';

	foreach ( $attr as $key => $value ) {
		if ( is_scalar( $value ) ) {
			$html .= ' ' . esc_attr( (string) $key ) . '="' . esc_attr( (string) $value ) . '"';
		}
	}

	return $html . ' />';
}
add_filter( 'woocommerce_product_get_image', 'fv_filtrar_imagen_producto_html', 10, 6 );

/**
 * Use the catalog image in the cart when it is not a Media attachment.
 *
 * @param string               $thumbnail Cart item thumbnail HTML.
 * @param array<string, mixed> $cart_item Cart item.
 * @return string
 */
function fv_filtrar_thumbnail_carrito( $thumbnail, $cart_item ) {
	$product_id = isset( $cart_item['product_id'] ) ? (int) $cart_item['product_id'] : 0;

	if ( ! $product_id || ! function_exists( 'wc_get_product' ) ) {
		return $thumbnail;
	}

	$product = wc_get_product( $product_id );

	if ( ! $product ) {
		return $thumbnail;
	}

	$url = fv_url_imagen_catalogo( $product->get_sku() );

	if ( '' === $url || fv_attachment_id_desde_url( $url ) ) {
		return $thumbnail;
	}

	return '<img src="' . esc_url( $url ) . '" alt="' . esc_attr( $product->get_name() ) . '" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" />';
}
add_filter( 'woocommerce_cart_item_thumbnail', 'fv_filtrar_thumbnail_carrito', 10, 2 );

/**
 * Use the theme placeholder for products without an image.
 *
 * @return string
 */
function fv_placeholder_producto(): string {
	return FV_URI . '/assets/img/producto-placeholder.svg';
}
add_filter( 'woocommerce_placeholder_img_src', 'fv_placeholder_producto' );

/**
 * Refresh the header cart counter after an AJAX add-to-cart.
 *
 * @param array<string, string> $fragments Fragments to replace.
 * @return array<string, string>
 */
function fv_fragmentos_contador_carrito( array $fragments ): array {
	$count = function_exists( 'WC' ) && WC()->cart ? (int) WC()->cart->get_cart_contents_count() : 0;

	$fragments['.fv-cart-link__count'] = '<span class="fv-cart-link__count">' . esc_html( (string) $count ) . '</span>';

	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'fv_fragmentos_contador_carrito' );

/**
 * Add the theme button classes without dropping WooCommerce's AJAX classes.
 *
 * @param array<string, mixed> $args    Add-to-cart template args.
 * @param WC_Product           $product Product object.
 * @return array<string, mixed>
 */
function fv_clases_boton_agregar( array $args, $product ): array {
	$class = isset( $args['class'] ) ? (string) $args['class'] : '';
	$args['class'] = trim( $class . ' fv-btn fv-btn--ghost' );

	return $args;
}
add_filter( 'woocommerce_loop_add_to_cart_args', 'fv_clases_boton_agregar', 10, 2 );
