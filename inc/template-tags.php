<?php
/**
 * Template tags and small presentation helpers.
 *
 * @package FaunaDelVelazco
 */

defined( 'ABSPATH' ) || exit;

/**
 * Return an inline SVG icon.
 *
 * Icons are stroke-based so they inherit the current text color.
 *
 * @param string $name  Icon name.
 * @param string $class CSS classes for the SVG element.
 * @return string
 */
function fv_icon( string $name, string $class = 'h-5 w-5' ): string {
	$icons = array(
		'arrow-right'    => '<path d="M4 12h16"/><path d="m14 6 6 6-6 6"/>',
		'arrow-up-right' => '<path d="M7 17 17 7"/><path d="M8 7h9v9"/>',
		'calendar'       => '<rect x="3" y="5" width="18" height="16" rx="2"/><path d="M16 3v4M8 3v4M3 10h18"/>',
		'clock'          => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
		'map-pin'        => '<path d="M20 10c0 5-8 12-8 12S4 15 4 10a8 8 0 1 1 16 0Z"/><circle cx="12" cy="10" r="2.5"/>',
		'phone'          => '<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.79 19.79 0 0 1 2.12 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92Z"/>',
		'whatsapp'       => '<path d="M21 11.5a8.5 8.5 0 0 1-12.6 7.4L3 21l2.1-5.4A8.5 8.5 0 1 1 21 11.5Z"/><path d="M8.5 9.5c.4 2.2 2.3 4.1 4.5 4.5l1-1.2 1.7.7"/>',
		'stethoscope'    => '<path d="M11 2v2"/><path d="M5 2v2"/><path d="M5 3H4a2 2 0 0 0-2 2v4a6 6 0 0 0 12 0V5a2 2 0 0 0-2-2h-1"/><path d="M8 15a6 6 0 0 0 12 0v-3"/><circle cx="20" cy="10" r="2"/>',
		'syringe'        => '<path d="m18 2 4 4"/><path d="m17 7 3-3"/><path d="M19 9 8.7 19.3c-1 1-2.5 1-3.4 0l-.6-.6c-1-1-1-2.5 0-3.4L15 5"/><path d="m9 11 4 4"/><path d="m5 19-3 3"/><path d="m14 4 6 6"/>',
		'scissors'       => '<circle cx="6" cy="6" r="3"/><path d="M8.1 8.1 20 20"/><path d="M20 4 8.1 15.9"/><circle cx="6" cy="18" r="3"/>',
		'shopping-bag'   => '<path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/>',
		'paw'            => '<circle cx="7" cy="8" r="2"/><circle cx="12" cy="6" r="2"/><circle cx="17" cy="8" r="2"/><path d="M12 11c3 0 5 2 5 4.5S15 20 12 20s-5-2-5-4.5S9 11 12 11Z"/>',
		'check'          => '<path d="m5 12 4 4L19 6"/>',
		'shield'         => '<path d="M12 3 5 6v5c0 5 3.5 8 7 10 3.5-2 7-5 7-10V6l-7-3Z"/><path d="m9 12 2 2 4-4"/>',
		'credit-card'    => '<rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/>',
		'chevron-down'   => '<path d="m6 9 6 6 6-6"/>',
		'menu'           => '<path d="M4 7h16M4 12h16M4 17h16"/>',
		'close'          => '<path d="M6 6l12 12M18 6 6 18"/>',
		'plus'           => '<path d="M12 5v14M5 12h14"/>',
		'quote'          => '<path d="M10 11H6a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v7a3 3 0 0 1-3 3"/><path d="M19 11h-4a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v7a3 3 0 0 1-3 3"/>',
		'instagram'      => '<rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><path d="M17.5 6.5h.01"/>',
		'facebook'       => '<path d="M14 8h3V5h-3c-2.2 0-4 1.8-4 4v2H7v3h3v7h3v-7h3l1-3h-4V9c0-.6.4-1 1-1Z"/>',
		'mail'           => '<rect x="2" y="4" width="20" height="16" rx="2"/><path d="m2 7 10 6 10-6"/>',
		'heart'          => '<path d="M20.8 5.6a5.5 5.5 0 0 0-7.8 0L12 6.6l-1-1a5.5 5.5 0 0 0-7.8 7.8l1 1L12 22l7.8-7.6 1-1a5.5 5.5 0 0 0 0-7.8Z"/>',
		'leaf'           => '<path d="M4 20c8 0 16-4 16-16-8 0-16 4-16 16Z"/><path d="M4 20c2-6 6-10 12-12"/>',
		'sparkles'       => '<path d="m12 3 1.9 4.6L18.5 9.5l-4.6 1.9L12 16l-1.9-4.6L5.5 9.5l4.6-1.9L12 3Z"/><path d="M19 15l.8 2.2L22 18l-2.2.8L19 21l-.8-2.2L16 18l2.2-.8L19 15Z"/>',
		'search'         => '<circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/>',
		'external'       => '<path d="M14 3h7v7"/><path d="M10 14 21 3"/><path d="M21 14v5a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5"/>',
	);

	if ( ! isset( $icons[ $name ] ) ) {
		return '';
	}

	return sprintf(
		'<svg class="%1$s" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">%2$s</svg>',
		esc_attr( $class ),
		$icons[ $name ]
	);
}

/**
 * Get the clinic phone number.
 *
 * @return string
 */
function fv_get_phone(): string {
	return (string) get_theme_mod( 'fv_phone', '' );
}

/**
 * Get a tel: URL for the clinic phone.
 *
 * @return string
 */
function fv_get_phone_href(): string {
	$phone = preg_replace( '/[^\d+]/', '', fv_get_phone() );

	return $phone ? 'tel:' . $phone : '';
}

/**
 * Get the WhatsApp number with digits only.
 *
 * @return string
 */
function fv_get_whatsapp_number(): string {
	return (string) preg_replace( '/\D+/', '', (string) get_theme_mod( 'fv_whatsapp', '' ) );
}

/**
 * Whether a WhatsApp number is configured.
 *
 * @return bool
 */
function fv_has_whatsapp(): bool {
	return '' !== fv_get_whatsapp_number();
}

/**
 * Get the WhatsApp URL.
 *
 * @return string
 */
function fv_get_whatsapp_url(): string {
	$number = fv_get_whatsapp_number();

	return $number ? 'https://wa.me/' . $number : fv_get_booking_url();
}

/**
 * Get the booking URL.
 *
 * @return string
 */
function fv_get_booking_url(): string {
	$url = (string) get_theme_mod( 'fv_booking_url', home_url( '/#reservar' ) );

	return $url ? $url : home_url( '/#reservar' );
}

/**
 * Get the shop URL.
 *
 * @return string
 */
function fv_get_shop_url(): string {
	if ( function_exists( 'wc_get_page_permalink' ) ) {
		$shop_url = wc_get_page_permalink( 'shop' );
		if ( $shop_url ) {
			return $shop_url;
		}
	}

	return home_url( '/tienda/' );
}

/**
 * Get the clinic address.
 *
 * @return string
 */
function fv_get_address(): string {
	return (string) get_theme_mod( 'fv_address', __( 'Velazco, Buenos Aires', 'fauna-del-velazco' ) );
}

/**
 * Get the clinic opening hours.
 *
 * @return string
 */
function fv_get_hours(): string {
	return (string) get_theme_mod( 'fv_hours', __( 'Lun a Vie · 9 a 19 h', 'fauna-del-velazco' ) );
}

/**
 * Get the clinic email.
 *
 * @return string
 */
function fv_get_email(): string {
	return (string) get_theme_mod( 'fv_email', '' );
}

/**
 * Get the Instagram URL.
 *
 * @return string
 */
function fv_get_instagram_url(): string {
	return (string) get_theme_mod( 'fv_instagram', '' );
}

/**
 * Get the Facebook URL.
 *
 * @return string
 */
function fv_get_facebook_url(): string {
	return (string) get_theme_mod( 'fv_facebook', '' );
}
