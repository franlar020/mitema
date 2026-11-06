<?php
/**
 * Theme setup: supports, menus, image sizes and widget areas.
 *
 * @package FaunaDelVelazco
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register theme supports, menus, image sizes and widget areas.
 */
function fv_theme_setup(): void {
	load_theme_textdomain( 'fauna-del-velazco', FV_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
			'navigation-widgets',
		)
	);
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 160,
			'width'       => 560,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'wp-block-styles' );

	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 600,
			'single_image_width'    => 900,
			'product_grid'          => array(
				'default_columns' => 4,
				'default_rows'    => 3,
				'min_columns'     => 2,
				'max_columns'     => 4,
			),
		)
	);
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	register_nav_menus(
		array(
			'primary' => __( 'Menú principal', 'fauna-del-velazco' ),
			'footer'  => __( 'Menú del pie', 'fauna-del-velazco' ),
			'legal'   => __( 'Menú legal', 'fauna-del-velazco' ),
		)
	);

	add_image_size( 'fv-hero', 1600, 900, true );
	add_image_size( 'fv-card', 600, 600, true );
	add_image_size( 'fv-portrait', 900, 1100, true );
	add_image_size( 'fv-logo', 560, 160, false );
}
add_action( 'after_setup_theme', 'fv_theme_setup' );

/**
 * Set the content width.
 */
function fv_content_width(): void {
	$GLOBALS['content_width'] = apply_filters( 'fv_content_width', 1200 );
}
add_action( 'after_setup_theme', 'fv_content_width', 0 );

/**
 * Register widget areas.
 */
function fv_widgets_init(): void {
	register_sidebar(
		array(
			'name'          => __( 'Barra lateral de la tienda', 'fauna-del-velazco' ),
			'id'            => 'shop-sidebar',
			'description'   => __( 'Widgets para filtros y navegación de la tienda.', 'fauna-del-velazco' ),
			'before_widget' => '<section id="%1$s" class="fv-widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="fv-widget__title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'fv_widgets_init' );

/**
 * Add contextual body classes.
 *
 * @param string[] $classes Body classes.
 * @return string[]
 */
function fv_body_classes( array $classes ): array {
	if ( is_front_page() ) {
		$classes[] = 'fv-front-page';
	}

	if ( is_singular() ) {
		$classes[] = 'fv-singular';
	}

	if ( function_exists( 'is_woocommerce' ) && ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() ) ) {
		$classes[] = 'fv-woocommerce';
	}

	return $classes;
}
add_filter( 'body_class', 'fv_body_classes' );

/**
 * Remove the "Category:", "Tag:" and "Month:" prefixes from archive titles.
 *
 * @return string
 */
function fv_archive_title_prefix(): string {
	return '';
}
add_filter( 'get_the_archive_title_prefix', 'fv_archive_title_prefix' );
