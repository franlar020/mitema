<?php
/**
 * Customizer settings for clinic contact details.
 *
 * @package FaunaDelVelazco
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register clinic contact settings.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager.
 */
function fv_customize_register( WP_Customize_Manager $wp_customize ): void {
	$wp_customize->add_section(
		'fv_contact',
		array(
			'title'       => __( 'Fauna del Velazco · Contacto', 'fauna-del-velazco' ),
			'description' => __( 'Datos que se muestran en el encabezado, el pie y la sección de contacto.', 'fauna-del-velazco' ),
			'priority'    => 30,
		)
	);

	$fields = array(
		'fv_phone'       => array(
			'label'    => __( 'Teléfono', 'fauna-del-velazco' ),
			'type'     => 'text',
			'default'  => '',
			'sanitize' => 'sanitize_text_field',
		),
		'fv_whatsapp'    => array(
			'label'       => __( 'WhatsApp', 'fauna-del-velazco' ),
			'description' => __( 'Solo números, con código de país. Ejemplo: 5491123456789.', 'fauna-del-velazco' ),
			'type'        => 'text',
			'default'     => '',
			'sanitize'    => 'sanitize_text_field',
		),
		'fv_email'       => array(
			'label'    => __( 'Email', 'fauna-del-velazco' ),
			'type'     => 'email',
			'default'  => '',
			'sanitize' => 'sanitize_email',
		),
		'fv_address'     => array(
			'label'    => __( 'Dirección', 'fauna-del-velazco' ),
			'type'     => 'text',
			'default'  => __( 'Velazco, Buenos Aires', 'fauna-del-velazco' ),
			'sanitize' => 'sanitize_text_field',
		),
		'fv_hours'       => array(
			'label'    => __( 'Horarios', 'fauna-del-velazco' ),
			'type'     => 'text',
			'default'  => __( 'Lun a Vie · 9 a 19 h', 'fauna-del-velazco' ),
			'sanitize' => 'sanitize_text_field',
		),
		'fv_booking_url' => array(
			'label'       => __( 'URL de reservas', 'fauna-del-velazco' ),
			'description' => __( 'Página o ancla a la que llevan los botones de turnos.', 'fauna-del-velazco' ),
			'type'        => 'url',
			'default'     => home_url( '/#reservar' ),
			'sanitize'    => 'esc_url_raw',
		),
		'fv_instagram'   => array(
			'label'    => __( 'Instagram', 'fauna-del-velazco' ),
			'type'     => 'url',
			'default'  => '',
			'sanitize' => 'esc_url_raw',
		),
		'fv_facebook'    => array(
			'label'    => __( 'Facebook', 'fauna-del-velazco' ),
			'type'     => 'url',
			'default'  => '',
			'sanitize' => 'esc_url_raw',
		),
	);

	foreach ( $fields as $id => $field ) {
		$wp_customize->add_setting(
			$id,
			array(
				'default'           => $field['default'],
				'sanitize_callback' => $field['sanitize'],
				'transport'         => 'refresh',
			)
		);

		$wp_customize->add_control(
			$id,
			array(
				'label'       => $field['label'],
				'description' => $field['description'] ?? '',
				'section'     => 'fv_contact',
				'type'        => $field['type'],
			)
		);
	}
}
add_action( 'customize_register', 'fv_customize_register' );
