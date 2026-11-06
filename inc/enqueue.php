<?php
/**
 * Frontend asset loading.
 *
 * @package FaunaDelVelazco
 */

defined( 'ABSPATH' ) || exit;

/**
 * Get a cache-busting version for a theme asset.
 *
 * @param string $relative_path Path relative to the theme root.
 * @return string
 */
function fv_asset_version( string $relative_path ): string {
	$absolute_path = FV_DIR . $relative_path;

	return file_exists( $absolute_path ) ? (string) filemtime( $absolute_path ) : FV_VERSION;
}

/**
 * Enqueue compiled theme assets.
 */
function fv_enqueue_assets(): void {
	$css = '/assets/dist/app.css';

	if ( file_exists( FV_DIR . $css ) ) {
		wp_enqueue_style( 'fv-app', FV_URI . $css, array(), fv_asset_version( $css ) );
	}

	$js = '/assets/dist/app.js';

	if ( file_exists( FV_DIR . $js ) ) {
		wp_enqueue_script(
			'fv-app',
			FV_URI . $js,
			array(),
			fv_asset_version( $js ),
			array(
				'strategy'  => 'defer',
				'in_footer' => true,
			)
		);
	}
}
add_action( 'wp_enqueue_scripts', 'fv_enqueue_assets' );

/**
 * Preload the self-hosted variable fonts used above the fold.
 */
function fv_preload_fonts(): void {
	$fonts = array(
		'fraunces-latin-standard-normal.woff2',
		'manrope-latin-wght-normal.woff2',
	);

	foreach ( $fonts as $font ) {
		printf(
			'<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>',
			esc_url( FV_URI . '/assets/fonts/' . $font )
		);
	}
}
add_action( 'wp_head', 'fv_preload_fonts', 1 );

/**
 * Warn administrators when the compiled assets are missing.
 */
function fv_missing_assets_notice(): void {
	if ( ! current_user_can( 'manage_options' ) || file_exists( FV_DIR . '/assets/dist/app.css' ) ) {
		return;
	}

	printf(
		'<div class="notice notice-warning"><p>%s</p></div>',
		esc_html__( 'Fauna del Velazco: falta compilar los assets. Ejecutá "npm install" y "npm run build".', 'fauna-del-velazco' )
	);
}
add_action( 'admin_notices', 'fv_missing_assets_notice' );
