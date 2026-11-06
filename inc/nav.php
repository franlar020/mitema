<?php
/**
 * Navigation fallbacks.
 *
 * @package FaunaDelVelazco
 */

defined( 'ABSPATH' ) || exit;

/**
 * Primary menu fallback.
 *
 * @param array $args Menu arguments.
 */
function fv_primary_menu_fallback( array $args = array() ): void {
	$items = array(
		array(
			'label' => __( 'Servicios', 'fauna-del-velazco' ),
			'url'   => home_url( '/#servicios' ),
		),
		array(
			'label' => __( 'Turnos', 'fauna-del-velazco' ),
			'url'   => home_url( '/#reservar' ),
		),
		array(
			'label' => __( 'Tienda', 'fauna-del-velazco' ),
			'url'   => fv_get_shop_url(),
		),
		array(
			'label' => __( 'Nosotros', 'fauna-del-velazco' ),
			'url'   => home_url( '/#nosotros' ),
		),
		array(
			'label' => __( 'Contacto', 'fauna-del-velazco' ),
			'url'   => home_url( '/#contacto' ),
		),
	);

	echo '<ul class="fv-nav__list">';
	foreach ( $items as $item ) {
		printf(
			'<li><a href="%1$s">%2$s</a></li>',
			esc_url( $item['url'] ),
			esc_html( $item['label'] )
		);
	}
	echo '</ul>';
}

/**
 * Footer menu fallback.
 */
function fv_footer_menu_fallback(): void {
	$items = array(
		array(
			'label' => __( 'Servicios', 'fauna-del-velazco' ),
			'url'   => home_url( '/#servicios' ),
		),
		array(
			'label' => __( 'Reservar turno', 'fauna-del-velazco' ),
			'url'   => home_url( '/#reservar' ),
		),
		array(
			'label' => __( 'Tienda', 'fauna-del-velazco' ),
			'url'   => fv_get_shop_url(),
		),
		array(
			'label' => __( 'Sobre la clínica', 'fauna-del-velazco' ),
			'url'   => home_url( '/#nosotros' ),
		),
		array(
			'label' => __( 'Contacto', 'fauna-del-velazco' ),
			'url'   => home_url( '/#contacto' ),
		),
	);

	echo '<ul class="fv-footer__list">';
	foreach ( $items as $item ) {
		printf(
			'<li><a href="%1$s">%2$s</a></li>',
			esc_url( $item['url'] ),
			esc_html( $item['label'] )
		);
	}
	echo '</ul>';
}

/**
 * Legal menu fallback.
 */
function fv_legal_menu_fallback(): void {
	$items = array();

	$privacy_url = get_privacy_policy_url();
	if ( $privacy_url ) {
		$items[] = array(
			'label' => __( 'Política de privacidad', 'fauna-del-velazco' ),
			'url'   => $privacy_url,
			'external' => false,
		);
	}

	$items[] = array(
		'label'    => __( 'Defensa de las y los consumidores', 'fauna-del-velazco' ),
		'url'      => 'https://www.argentina.gob.ar/produccion/defensadelconsumidor/formulario',
		'external' => true,
	);

	echo '<ul class="fv-footer__legal">';
	foreach ( $items as $item ) {
		printf(
			'<li><a href="%1$s"%2$s>%3$s</a></li>',
			esc_url( $item['url'] ),
			$item['external'] ? ' target="_blank" rel="noopener noreferrer"' : '',
			esc_html( $item['label'] )
		);
	}
	echo '</ul>';
}
