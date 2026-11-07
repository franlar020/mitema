<?php
/**
 * Crea o completa los productos de demostración de la tienda.
 *
 * Uso:
 *   C:\xampp\php\php.exe tools\sembrar-productos.php
 *
 * El script es idempotente: si un SKU ya existe, no lo duplica ni lo
 * sobreescribe. Los productos nuevos se crean publicados y con stock.
 *
 * @package FaunaDelVelazco
 */

if ( 'cli' !== PHP_SAPI ) {
	exit( "Este script solo se puede ejecutar desde la línea de comandos.\n" );
}

$wp_root = dirname( __DIR__, 4 ) . '/wp-load.php';

if ( ! file_exists( $wp_root ) ) {
	fwrite( STDERR, "No se encontró wp-load.php en {$wp_root}\n" );
	exit( 1 );
}

define( 'WP_USE_THEMES', false );

$_SERVER['HTTP_HOST']   = 'localhost';
$_SERVER['REQUEST_URI'] = '/webwordpress/';

require_once $wp_root;

if ( ! function_exists( 'wc_get_product' ) ) {
	fwrite( STDERR, "WooCommerce no está activo.\n" );
	exit( 1 );
}

require_once dirname( __DIR__ ) . '/inc/catalogo-productos.php';

$admins = get_users(
	array(
		'role'   => 'administrator',
		'number' => 1,
		'fields' => 'ID',
	)
);

if ( ! empty( $admins ) ) {
	wp_set_current_user( (int) $admins[0] );
}

/**
 * Return a product category ID, creating the term when needed.
 *
 * @param string $name Category name.
 * @return int
 */
function fv_sembrar_categoria( string $name ): int {
	$term = term_exists( $name, 'product_cat' );

	if ( ! $term ) {
		$term = wp_insert_term( $name, 'product_cat' );
	}

	if ( is_wp_error( $term ) ) {
		fwrite( STDERR, "No se pudo crear la categoría {$name}: " . $term->get_error_message() . "\n" );
		return 0;
	}

	return (int) ( is_array( $term ) ? $term['term_id'] : $term );
}

$catalogo = fv_catalogo_productos();
$creados  = 0;
$saltados = 0;

foreach ( $catalogo as $sku => $item ) {
	$existing_id = wc_get_product_id_by_sku( $sku );

	if ( $existing_id ) {
		++$saltados;
		echo "SKIP  {$sku} · ya existe (ID {$existing_id})\n";
		continue;
	}

	$categoria_id = fv_sembrar_categoria( (string) $item['categoria'] );

	if ( ! $categoria_id ) {
		fwrite( STDERR, "SKIP  {$sku} · sin categoría válida\n" );
		continue;
	}

	$producto = new WC_Product_Simple();
	$producto->set_name( (string) $item['nombre'] );
	$producto->set_sku( $sku );
	$producto->set_status( 'publish' );
	$producto->set_catalog_visibility( 'visible' );
	$producto->set_description( (string) $item['descripcion'] );
	$producto->set_short_description( (string) $item['descripcion_corta'] );
	$producto->set_regular_price( (string) $item['precio'] );
	$producto->set_price( (string) $item['precio'] );
	$producto->set_category_ids( array( $categoria_id ) );
	$producto->set_manage_stock( true );
	$producto->set_stock_quantity( (int) $item['stock'] );
	$producto->set_stock_status( 'instock' );
	$producto->set_low_stock_amount( 3 );
	$producto->set_backorders( 'no' );
	$producto->set_featured( ! empty( $item['destacado'] ) );
	$producto->set_menu_order( $creados );

	$producto_id = $producto->save();

	if ( ! $producto_id ) {
		fwrite( STDERR, "ERROR {$sku} · no se pudo guardar\n" );
		continue;
	}

	$imagen_url = trim( (string) $item['imagen'] );

	if ( '' !== $imagen_url ) {
		$attachment_id = attachment_url_to_postid( strtok( $imagen_url, '?' ) );

		if ( $attachment_id ) {
			$producto->set_image_id( (int) $attachment_id );
			$producto->save();
		}
	}

	++$creados;
	echo "OK    {$sku} · {$item['nombre']} (ID {$producto_id})\n";
}

echo "\nListo: {$creados} creados, {$saltados} existentes.\n";
