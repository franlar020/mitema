<?php
/**
 * Logo and favicon helpers.
 *
 * @package FaunaDelVelazco
 */

defined( 'ABSPATH' ) || exit;

/**
 * Render the site logo, falling back to the bundled SVG wordmark.
 */
function fv_get_logo(): void {
	if ( has_custom_logo() ) {
		the_custom_logo();
		return;
	}

	$site_name = get_bloginfo( 'name' );
	$site_name = $site_name ? $site_name : __( 'Fauna del Velazco', 'fauna-del-velazco' );

	printf(
		'<a class="fv-logo" href="%1$s" rel="home" aria-label="%2$s"><img src="%3$s" alt="%2$s" width="560" height="160" loading="eager" decoding="async"></a>',
		esc_url( home_url( '/' ) ),
		esc_attr( $site_name ),
		esc_url( FV_URI . '/assets/img/logo-horizontal.svg' )
	);
}

/**
 * Add a favicon and theme color when no site icon is configured.
 */
function fv_favicon_fallback(): void {
	if ( has_site_icon() ) {
		return;
	}

	printf(
		'<link rel="icon" href="%s" type="image/svg+xml">',
		esc_url( FV_URI . '/assets/img/favicon.svg' )
	);
	printf(
		'<meta name="theme-color" content="%s">',
		esc_attr( '#1F3D2B' )
	);
}
add_action( 'wp_head', 'fv_favicon_fallback', 5 );
