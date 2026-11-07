<?php
/**
 * Theme header.
 *
 * @package FaunaDelVelazco
 */

defined( 'ABSPATH' ) || exit;

$fv_cart_count = function_exists( 'WC' ) && WC()->cart ? (int) WC()->cart->get_cart_contents_count() : 0;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="fv-skip-link" href="#primary"><?php esc_html_e( 'Saltar al contenido', 'fauna-del-velazco' ); ?></a>

<div class="fv-topbar">
	<div class="fv-container flex flex-wrap items-center justify-between gap-x-6 gap-y-2 py-2 text-[0.7rem] font-semibold tracking-wide">
		<p class="flex items-center gap-2">
			<?php echo fv_icon( 'clock', 'h-3.5 w-3.5' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<?php echo esc_html( fv_get_hours() ); ?>
		</p>
		<p class="hidden items-center gap-2 sm:flex">
			<?php echo fv_icon( 'map-pin', 'h-3.5 w-3.5' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<?php echo esc_html( fv_get_address() ); ?>
		</p>
		<?php if ( fv_get_phone() ) : ?>
			<a class="flex items-center gap-2" href="<?php echo esc_url( fv_get_phone_href() ); ?>">
				<?php echo fv_icon( 'phone', 'h-3.5 w-3.5' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<?php echo esc_html( fv_get_phone() ); ?>
			</a>
		<?php elseif ( fv_has_whatsapp() ) : ?>
			<a class="flex items-center gap-2" href="<?php echo esc_url( fv_get_whatsapp_url() ); ?>" target="_blank" rel="noopener noreferrer">
				<?php echo fv_icon( 'whatsapp', 'h-3.5 w-3.5' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<?php esc_html_e( 'Escribinos por WhatsApp', 'fauna-del-velazco' ); ?>
			</a>
		<?php endif; ?>
	</div>
</div>

<header class="fv-header">
	<div class="fv-container flex items-center justify-between gap-6 py-4">
		<div class="fv-header__brand shrink-0">
			<?php fv_get_logo(); ?>
		</div>

		<nav class="fv-nav hidden lg:block" aria-label="<?php esc_attr_e( 'Menú principal', 'fauna-del-velazco' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'fv-nav__list',
					'fallback_cb'    => 'fv_primary_menu_fallback',
					'depth'          => 2,
				)
			);
			?>
		</nav>

		<div class="hidden items-center gap-3 lg:flex">
			<?php if ( function_exists( 'wc_get_cart_url' ) ) : ?>
				<a class="fv-cart-link" href="<?php echo esc_url( wc_get_cart_url() ); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'Ver carrito, %d productos', 'fauna-del-velazco' ), $fv_cart_count ) ); ?>">
					<?php echo fv_icon( 'shopping-bag', 'h-5 w-5' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<span class="fv-cart-link__count"><?php echo esc_html( (string) $fv_cart_count ); ?></span>
				</a>
			<?php endif; ?>
			<a class="fv-btn fv-btn--primary" href="<?php echo esc_url( fv_get_booking_url() ); ?>">
				<?php esc_html_e( 'Reservar turno', 'fauna-del-velazco' ); ?>
				<?php echo fv_icon( 'arrow-right', 'h-4 w-4' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</a>
		</div>

		<button
			class="fv-menu-toggle lg:hidden"
			type="button"
			aria-controls="fv-mobile-menu"
			aria-expanded="false"
			data-fv-menu-toggle
		>
			<span class="sr-only" data-fv-menu-label><?php esc_html_e( 'Abrir menú', 'fauna-del-velazco' ); ?></span>
			<span data-fv-icon-open><?php echo fv_icon( 'menu', 'h-6 w-6' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
			<span class="hidden" data-fv-icon-close><?php echo fv_icon( 'close', 'h-6 w-6' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
		</button>
	</div>

	<div id="fv-mobile-menu" class="fv-mobile-menu lg:hidden" hidden>
		<div class="fv-container py-6">
			<nav class="fv-nav fv-nav--mobile" aria-label="<?php esc_attr_e( 'Menú móvil', 'fauna-del-velazco' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'menu_class'     => 'fv-nav__list',
						'fallback_cb'    => 'fv_primary_menu_fallback',
						'depth'          => 2,
					)
				);
				?>
			</nav>
			<?php if ( function_exists( 'wc_get_cart_url' ) ) : ?>
				<a class="fv-btn fv-btn--ghost mt-4 w-full" href="<?php echo esc_url( wc_get_cart_url() ); ?>">
					<?php echo fv_icon( 'shopping-bag', 'h-4 w-4' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<?php echo esc_html( sprintf( __( 'Carrito (%d)', 'fauna-del-velazco' ), $fv_cart_count ) ); ?>
				</a>
			<?php endif; ?>
			<a class="fv-btn fv-btn--primary mt-6 w-full" href="<?php echo esc_url( fv_get_booking_url() ); ?>">
				<?php esc_html_e( 'Reservar turno', 'fauna-del-velazco' ); ?>
				<?php echo fv_icon( 'arrow-right', 'h-4 w-4' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</a>
		</div>
	</div>
</header>
