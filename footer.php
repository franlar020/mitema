<?php
/**
 * Theme footer.
 *
 * @package FaunaDelVelazco
 */

defined( 'ABSPATH' ) || exit;
?>
<footer class="fv-footer">
	<div class="fv-container">
		<div class="grid gap-12 py-16 lg:grid-cols-[1.4fr_0.8fr_1.1fr_1fr] lg:py-20">
			<div>
				<a class="inline-flex items-center gap-3 no-underline" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img class="h-14 w-14" src="<?php echo esc_url( FV_URI . '/assets/img/logo-mark.svg' ); ?>" alt="" width="120" height="120" loading="lazy" decoding="async">
					<span>
						<span class="block font-display text-2xl leading-none text-cream">Fauna del Velazco</span>
						<span class="mt-1 block text-[0.62rem] font-bold uppercase tracking-[0.22em] text-sage-soft"><?php esc_html_e( 'Clínica veterinaria', 'fauna-del-velazco' ); ?></span>
					</span>
				</a>
				<p class="mt-6 max-w-sm text-sm leading-relaxed text-cream/65">
					<?php esc_html_e( 'Consulta clínica, vacunación y peluquería con turnos coordinados. Una atención cercana para cada etapa de tu mascota.', 'fauna-del-velazco' ); ?>
				</p>

				<?php if ( fv_get_instagram_url() || fv_get_facebook_url() ) : ?>
					<div class="mt-6 flex items-center gap-3">
						<?php if ( fv_get_instagram_url() ) : ?>
							<a class="fv-footer__social" href="<?php echo esc_url( fv_get_instagram_url() ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Instagram', 'fauna-del-velazco' ); ?>">
								<?php echo fv_icon( 'instagram', 'h-5 w-5' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</a>
						<?php endif; ?>
						<?php if ( fv_get_facebook_url() ) : ?>
							<a class="fv-footer__social" href="<?php echo esc_url( fv_get_facebook_url() ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Facebook', 'fauna-del-velazco' ); ?>">
								<?php echo fv_icon( 'facebook', 'h-5 w-5' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</a>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>

			<div>
				<h2 class="fv-footer__title"><?php esc_html_e( 'Clínica', 'fauna-del-velazco' ); ?></h2>
				<div class="mt-5">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer',
							'container'      => false,
							'menu_class'     => 'fv-footer__list',
							'fallback_cb'    => 'fv_footer_menu_fallback',
							'depth'          => 1,
						)
					);
					?>
				</div>
			</div>

			<div>
				<h2 class="fv-footer__title"><?php esc_html_e( 'Contacto', 'fauna-del-velazco' ); ?></h2>
				<ul class="fv-footer__list mt-5">
					<li class="flex gap-3">
						<?php echo fv_icon( 'map-pin', 'mt-0.5 h-4 w-4 shrink-0 text-sage-soft' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<span><?php echo esc_html( fv_get_address() ); ?></span>
					</li>
					<li class="flex gap-3">
						<?php echo fv_icon( 'clock', 'mt-0.5 h-4 w-4 shrink-0 text-sage-soft' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<span><?php echo esc_html( fv_get_hours() ); ?></span>
					</li>
					<?php if ( fv_get_phone() ) : ?>
						<li class="flex gap-3">
							<?php echo fv_icon( 'phone', 'mt-0.5 h-4 w-4 shrink-0 text-sage-soft' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<a href="<?php echo esc_url( fv_get_phone_href() ); ?>"><?php echo esc_html( fv_get_phone() ); ?></a>
						</li>
					<?php endif; ?>
					<?php if ( fv_get_email() ) : ?>
						<li class="flex gap-3">
							<?php echo fv_icon( 'mail', 'mt-0.5 h-4 w-4 shrink-0 text-sage-soft' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<a href="mailto:<?php echo esc_attr( fv_get_email() ); ?>"><?php echo esc_html( fv_get_email() ); ?></a>
						</li>
					<?php endif; ?>
				</ul>
			</div>

			<div>
				<h2 class="fv-footer__title"><?php esc_html_e( 'Turnos', 'fauna-del-velazco' ); ?></h2>
				<p class="mt-5 text-sm leading-relaxed text-cream/65">
					<?php esc_html_e( 'Reservá online y confirmá con la seña. Te esperamos con un horario coordinado.', 'fauna-del-velazco' ); ?>
				</p>
				<a class="fv-btn fv-btn--light mt-6" href="<?php echo esc_url( fv_get_booking_url() ); ?>">
					<?php esc_html_e( 'Reservar turno', 'fauna-del-velazco' ); ?>
					<?php echo fv_icon( 'arrow-right', 'h-4 w-4' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</a>
				<?php if ( fv_has_whatsapp() ) : ?>
					<a class="fv-link-arrow mt-4 text-cream/75 hover:text-cream" href="<?php echo esc_url( fv_get_whatsapp_url() ); ?>" target="_blank" rel="noopener noreferrer">
						<?php echo fv_icon( 'whatsapp', 'h-4 w-4' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<?php esc_html_e( 'Consultar por WhatsApp', 'fauna-del-velazco' ); ?>
					</a>
				<?php endif; ?>
			</div>
		</div>

		<div class="fv-footer__bottom">
			<p><?php printf( esc_html__( '© %s Fauna del Velazco. Todos los derechos reservados.', 'fauna-del-velazco' ), esc_html( wp_date( 'Y' ) ) ); ?></p>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'legal',
					'container'      => false,
					'menu_class'     => 'fv-footer__legal',
					'fallback_cb'    => 'fv_legal_menu_fallback',
					'depth'          => 1,
				)
			);
			?>
			<p><?php esc_html_e( 'Hecho con cuidado en Velazco.', 'fauna-del-velazco' ); ?></p>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
