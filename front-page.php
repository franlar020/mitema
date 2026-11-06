<?php
/**
 * Front page.
 *
 * @package FaunaDelVelazco
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main id="primary" class="fv-main">

	<section class="fv-hero">
		<div class="fv-container fv-hero__grid">
			<div>
				<p class="fv-eyebrow fv-animate-in"><?php esc_html_e( 'Clínica veterinaria · Velazco', 'fauna-del-velazco' ); ?></p>
				<h1 class="fv-display fv-animate-in fv-delay-1 mt-5">
					<?php esc_html_e( 'Cuidar a tu mascota empieza por conocerla.', 'fauna-del-velazco' ); ?>
				</h1>
				<p class="fv-lead fv-animate-in fv-delay-2 mt-7">
					<?php esc_html_e( 'Consulta clínica, vacunación y peluquería con turnos coordinados. Un espacio tranquilo para que cada visita sea clara, a tiempo y sin sorpresas.', 'fauna-del-velazco' ); ?>
				</p>
				<div class="fv-animate-in fv-delay-3 mt-8 flex flex-wrap items-center gap-3">
					<a class="fv-btn fv-btn--primary" href="<?php echo esc_url( fv_get_booking_url() ); ?>">
						<?php esc_html_e( 'Reservar un turno', 'fauna-del-velazco' ); ?>
						<?php echo fv_icon( 'arrow-right', 'h-4 w-4' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</a>
					<a class="fv-btn fv-btn--ghost" href="#servicios">
						<?php esc_html_e( 'Ver servicios', 'fauna-del-velazco' ); ?>
					</a>
				</div>
				<p class="fv-animate-in fv-delay-4 mt-8 flex items-center gap-3 text-sm text-forest/60">
					<span class="flex h-9 w-9 items-center justify-center rounded-full bg-sage-soft/50 text-forest">
						<?php echo fv_icon( 'paw', 'h-4 w-4' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</span>
					<span><strong class="font-semibold text-forest"><?php esc_html_e( 'Dra. Victoria Boratto', 'fauna-del-velazco' ); ?></strong><br><?php esc_html_e( 'Médica Veterinaria', 'fauna-del-velazco' ); ?></span>
				</p>
			</div>

			<div class="fv-hero__visual fv-animate-in fv-delay-2">
				<div class="fv-hero__disc" aria-hidden="true"></div>
				<img class="fv-hero__mark" src="<?php echo esc_url( FV_URI . '/assets/img/logo-mark.svg' ); ?>" alt="" width="120" height="120" loading="eager" decoding="async">
				<img class="fv-hero__branch" src="<?php echo esc_url( FV_URI . '/assets/img/botanical-branch.svg' ); ?>" alt="" width="220" height="360" loading="eager" decoding="async">
				<div class="fv-hero__note w-56">
					<p class="flex items-center gap-2 text-[0.65rem] font-bold uppercase tracking-[0.18em] text-terracotta-ink">
						<?php echo fv_icon( 'calendar', 'h-4 w-4' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<?php esc_html_e( 'Atención con turno', 'fauna-del-velazco' ); ?>
					</p>
					<p class="mt-2 font-display text-lg leading-tight text-forest"><?php echo esc_html( fv_get_hours() ); ?></p>
					<p class="mt-1 text-xs leading-relaxed text-forest/60"><?php esc_html_e( 'Seña online con Mercado Pago.', 'fauna-del-velazco' ); ?></p>
				</div>
			</div>
		</div>
	</section>

	<section class="fv-trust" aria-label="<?php esc_attr_e( 'Por qué elegir Fauna del Velazco', 'fauna-del-velazco' ); ?>">
		<div class="fv-container grid sm:grid-cols-3 sm:divide-x sm:divide-forest/15">
			<div class="fv-trust__item border-b border-forest/15 sm:border-b-0 sm:pr-8">
				<span class="text-terracotta"><?php echo fv_icon( 'stethoscope', 'h-5 w-5' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				<div>
					<p class="text-sm font-semibold text-forest"><?php esc_html_e( 'Una profesional dedicada', 'fauna-del-velazco' ); ?></p>
					<p class="mt-1 text-xs leading-relaxed text-forest/60"><?php esc_html_e( 'Seguimiento real, no un call center.', 'fauna-del-velazco' ); ?></p>
				</div>
			</div>
			<div class="fv-trust__item border-b border-forest/15 py-6 sm:border-b-0 sm:px-8 sm:py-6">
				<span class="text-terracotta"><?php echo fv_icon( 'clock', 'h-5 w-5' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				<div>
					<p class="text-sm font-semibold text-forest"><?php esc_html_e( 'Horarios que se respetan', 'fauna-del-velazco' ); ?></p>
					<p class="mt-1 text-xs leading-relaxed text-forest/60"><?php esc_html_e( 'Turnos coordinados y confirmados.', 'fauna-del-velazco' ); ?></p>
				</div>
			</div>
			<div class="fv-trust__item py-6 sm:py-6 sm:pl-8">
				<span class="text-terracotta"><?php echo fv_icon( 'shield', 'h-5 w-5' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				<div>
					<p class="text-sm font-semibold text-forest"><?php esc_html_e( 'Compra y reserva online', 'fauna-del-velazco' ); ?></p>
					<p class="mt-1 text-xs leading-relaxed text-forest/60"><?php esc_html_e( 'Tienda WooCommerce y seña con Mercado Pago.', 'fauna-del-velazco' ); ?></p>
				</div>
			</div>
		</div>
	</section>

	<section id="servicios" class="fv-section">
		<div class="fv-container grid gap-14 lg:grid-cols-[0.8fr_1.2fr] lg:gap-20">
			<div class="lg:sticky lg:top-28 lg:self-start">
				<p class="fv-eyebrow"><?php esc_html_e( 'Servicios', 'fauna-del-velazco' ); ?></p>
				<h2 class="fv-display fv-display--md mt-4"><?php esc_html_e( 'Todo lo que necesita, en un mismo lugar.', 'fauna-del-velazco' ); ?></h2>
				<p class="fv-lead mt-6">
					<?php esc_html_e( 'Un circuito simple para el cuidado clínico, la prevención y la estética. Elegí el servicio y coordinamos el resto.', 'fauna-del-velazco' ); ?>
				</p>
				<div class="fv-detail mt-8">
					<p class="text-sm font-semibold text-forest"><?php esc_html_e( '¿Es una urgencia?', 'fauna-del-velazco' ); ?></p>
					<p class="mt-2 text-sm leading-relaxed text-forest/65"><?php esc_html_e( 'Escribinos y te orientamos. Si está fuera del horario, buscá atención inmediata.', 'fauna-del-velazco' ); ?></p>
					<?php if ( fv_has_whatsapp() ) : ?>
						<a class="fv-link-arrow mt-4" href="<?php echo esc_url( fv_get_whatsapp_url() ); ?>" target="_blank" rel="noopener noreferrer">
							<?php echo fv_icon( 'whatsapp', 'h-4 w-4' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<?php esc_html_e( 'Escribir por WhatsApp', 'fauna-del-velazco' ); ?>
						</a>
					<?php else : ?>
						<a class="fv-link-arrow mt-4" href="#contacto">
							<?php esc_html_e( 'Ver canales de contacto', 'fauna-del-velazco' ); ?>
							<?php echo fv_icon( 'arrow-right', 'h-4 w-4' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</a>
					<?php endif; ?>
				</div>
			</div>

			<div>
				<article class="fv-service-row group">
					<div class="fv-service-row__icon"><?php echo fv_icon( 'stethoscope', 'h-5 w-5' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
					<div>
						<h3><?php esc_html_e( 'Consulta clínica', 'fauna-del-velazco' ); ?></h3>
						<p><?php esc_html_e( 'Revisión general, diagnóstico y seguimiento con un plan claro para tu mascota.', 'fauna-del-velazco' ); ?></p>
					</div>
					<a class="fv-link-arrow" href="<?php echo esc_url( fv_get_booking_url() ); ?>">
						<?php esc_html_e( 'Reservar', 'fauna-del-velazco' ); ?>
						<?php echo fv_icon( 'arrow-up-right', 'h-4 w-4' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</a>
				</article>

				<article class="fv-service-row group">
					<div class="fv-service-row__icon"><?php echo fv_icon( 'syringe', 'h-5 w-5' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
					<div>
						<h3><?php esc_html_e( 'Vacunación y control', 'fauna-del-velazco' ); ?></h3>
						<p><?php esc_html_e( 'Calendario de vacunas, desparasitación y controles preventivos para cada etapa.', 'fauna-del-velazco' ); ?></p>
					</div>
					<a class="fv-link-arrow" href="<?php echo esc_url( fv_get_booking_url() ); ?>">
						<?php esc_html_e( 'Reservar', 'fauna-del-velazco' ); ?>
						<?php echo fv_icon( 'arrow-up-right', 'h-4 w-4' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</a>
				</article>

				<article class="fv-service-row group">
					<div class="fv-service-row__icon"><?php echo fv_icon( 'scissors', 'h-5 w-5' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
					<div>
						<h3><?php esc_html_e( 'Peluquería', 'fauna-del-velazco' ); ?></h3>
						<p><?php esc_html_e( 'Baño, corte y cuidado con turnos que respetan los tiempos de cada animal.', 'fauna-del-velazco' ); ?></p>
					</div>
					<a class="fv-link-arrow" href="<?php echo esc_url( fv_get_booking_url() ); ?>">
						<?php esc_html_e( 'Reservar', 'fauna-del-velazco' ); ?>
						<?php echo fv_icon( 'arrow-up-right', 'h-4 w-4' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</a>
				</article>

				<article class="fv-service-row group">
					<div class="fv-service-row__icon"><?php echo fv_icon( 'shopping-bag', 'h-5 w-5' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
					<div>
						<h3><?php esc_html_e( 'Tienda', 'fauna-del-velazco' ); ?></h3>
						<p><?php esc_html_e( 'Alimentos, accesorios y productos elegidos para el día a día.', 'fauna-del-velazco' ); ?></p>
					</div>
					<a class="fv-link-arrow" href="<?php echo esc_url( fv_get_shop_url() ); ?>">
						<?php esc_html_e( 'Ver tienda', 'fauna-del-velazco' ); ?>
						<?php echo fv_icon( 'arrow-up-right', 'h-4 w-4' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</a>
				</article>
			</div>
		</div>
	</section>

	<section id="reservar" class="fv-section bg-forest text-cream">
		<div class="fv-container">
			<div class="grid gap-10 lg:grid-cols-[1fr_auto] lg:items-end">
				<div>
					<p class="fv-eyebrow text-sage-soft"><?php esc_html_e( 'Turnos', 'fauna-del-velazco' ); ?></p>
					<h2 class="fv-display fv-display--md fv-display--light mt-4"><?php esc_html_e( 'Reservá en tres pasos.', 'fauna-del-velazco' ); ?></h2>
					<p class="fv-lead fv-lead--light mt-6">
						<?php esc_html_e( 'Elegí el servicio, el horario y confirmá con la seña. Sin llamados ni idas y vueltas.', 'fauna-del-velazco' ); ?>
					</p>
				</div>
				<div class="flex flex-wrap gap-3">
					<a class="fv-btn fv-btn--light" href="<?php echo esc_url( fv_get_booking_url() ); ?>">
						<?php esc_html_e( 'Empezar reserva', 'fauna-del-velazco' ); ?>
						<?php echo fv_icon( 'arrow-right', 'h-4 w-4' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</a>
					<?php if ( fv_has_whatsapp() ) : ?>
						<a class="fv-btn fv-btn--ghost border-cream/25 text-cream hover:bg-cream hover:text-forest" href="<?php echo esc_url( fv_get_whatsapp_url() ); ?>" target="_blank" rel="noopener noreferrer">
							<?php echo fv_icon( 'whatsapp', 'h-4 w-4' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<?php esc_html_e( 'Consultar', 'fauna-del-velazco' ); ?>
						</a>
					<?php endif; ?>
				</div>
			</div>

			<div class="mt-14 grid gap-8 md:grid-cols-3">
				<div class="border-t border-cream/20 pt-6">
					<span class="font-display text-4xl text-sage-soft">01</span>
					<h3 class="mt-4 text-2xl text-cream"><?php esc_html_e( 'Elegí el servicio', 'fauna-del-velazco' ); ?></h3>
					<p class="mt-2 text-sm leading-relaxed text-cream/65"><?php esc_html_e( 'Consulta clínica, vacunación o peluquería.', 'fauna-del-velazco' ); ?></p>
				</div>
				<div class="border-t border-cream/20 pt-6">
					<span class="font-display text-4xl text-sage-soft">02</span>
					<h3 class="mt-4 text-2xl text-cream"><?php esc_html_e( 'Elegí día y horario', 'fauna-del-velazco' ); ?></h3>
					<p class="mt-2 text-sm leading-relaxed text-cream/65"><?php esc_html_e( 'Vas a ver solo los horarios disponibles.', 'fauna-del-velazco' ); ?></p>
				</div>
				<div class="border-t border-cream/20 pt-6">
					<span class="font-display text-4xl text-sage-soft">03</span>
					<h3 class="mt-4 text-2xl text-cream"><?php esc_html_e( 'Confirmá con la seña', 'fauna-del-velazco' ); ?></h3>
					<p class="mt-2 text-sm leading-relaxed text-cream/65"><?php esc_html_e( 'Pagás online con Mercado Pago y el turno queda reservado.', 'fauna-del-velazco' ); ?></p>
				</div>
			</div>

			<p class="mt-10 flex items-start gap-3 text-xs leading-relaxed text-cream/50">
				<?php echo fv_icon( 'credit-card', 'mt-0.5 h-4 w-4 shrink-0' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<?php esc_html_e( 'La seña se acredita con Mercado Pago. Si necesitás reprogramar, avisanos con 24 horas de anticipación.', 'fauna-del-velazco' ); ?>
			</p>
		</div>
	</section>

	<section id="tienda" class="fv-section">
		<div class="fv-container">
			<div class="flex flex-wrap items-end justify-between gap-6">
				<div>
					<p class="fv-eyebrow"><?php esc_html_e( 'Tienda', 'fauna-del-velazco' ); ?></p>
					<h2 class="fv-display fv-display--md mt-4"><?php esc_html_e( 'Para el día a día.', 'fauna-del-velazco' ); ?></h2>
					<p class="fv-lead mt-5"><?php esc_html_e( 'Alimentos, accesorios y cuidado seleccionados por la clínica.', 'fauna-del-velazco' ); ?></p>
				</div>
				<a class="fv-link-arrow" href="<?php echo esc_url( fv_get_shop_url() ); ?>">
					<?php esc_html_e( 'Ver toda la tienda', 'fauna-del-velazco' ); ?>
					<?php echo fv_icon( 'arrow-up-right', 'h-4 w-4' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</a>
			</div>

			<?php
			$fv_products = array();
			if ( function_exists( 'wc_get_products' ) ) {
				$fv_products = wc_get_products(
					array(
						'limit'   => 3,
						'status'  => 'publish',
						'orderby' => 'date',
						'order'   => 'DESC',
					)
				);
			}
			?>

			<?php if ( ! empty( $fv_products ) ) : ?>
				<div class="mt-12 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
					<?php foreach ( $fv_products as $fv_product ) : ?>
						<article class="fv-product group">
							<a class="fv-product__media" href="<?php echo esc_url( get_permalink( $fv_product->get_id() ) ); ?>">
								<?php
								$fv_image = get_the_post_thumbnail(
									$fv_product->get_id(),
									'fv-card',
									array(
										'class'   => 'h-full w-full object-cover transition duration-500 group-hover:scale-105',
										'loading' => 'lazy',
									)
								);
								if ( $fv_image ) {
									echo wp_kses_post( $fv_image );
								} else {
									echo '<span class="fv-product__placeholder">' . fv_icon( 'shopping-bag', 'h-10 w-10' ) . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								}
								?>
							</a>
							<div class="mt-4 flex items-start justify-between gap-4">
								<div>
									<h3 class="font-display text-xl text-forest">
										<a class="no-underline" href="<?php echo esc_url( get_permalink( $fv_product->get_id() ) ); ?>"><?php echo esc_html( $fv_product->get_name() ); ?></a>
									</h3>
									<div class="mt-1 text-sm text-forest/60"><?php echo wp_kses_post( $fv_product->get_price_html() ); ?></div>
								</div>
								<a class="fv-link-arrow shrink-0" href="<?php echo esc_url( get_permalink( $fv_product->get_id() ) ); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'Ver %s', 'fauna-del-velazco' ), $fv_product->get_name() ) ); ?>">
									<?php echo fv_icon( 'arrow-up-right', 'h-4 w-4' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								</a>
							</div>
						</article>
					<?php endforeach; ?>
				</div>
			<?php else : ?>
				<div class="mt-12 grid gap-8 sm:grid-cols-3">
					<?php
					$fv_categories = array(
						array(
							'icon'  => 'shopping-bag',
							'title' => __( 'Alimentos', 'fauna-del-velazco' ),
							'text'  => __( 'Opciones para cachorros, adultos y seniors.', 'fauna-del-velazco' ),
						),
						array(
							'icon'  => 'paw',
							'title' => __( 'Accesorios', 'fauna-del-velazco' ),
							'text'  => __( 'Paseo, descanso y juego para el día a día.', 'fauna-del-velazco' ),
						),
						array(
							'icon'  => 'shield',
							'title' => __( 'Cuidado', 'fauna-del-velazco' ),
							'text'  => __( 'Productos de higiene y cuidado recomendados.', 'fauna-del-velazco' ),
						),
					);
					foreach ( $fv_categories as $fv_category ) :
						?>
						<article class="border-t border-forest/15 pt-6">
							<span class="text-terracotta"><?php echo fv_icon( $fv_category['icon'], 'h-6 w-6' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
							<h3 class="mt-5 font-display text-2xl text-forest"><?php echo esc_html( $fv_category['title'] ); ?></h3>
							<p class="mt-2 text-sm leading-relaxed text-forest/60"><?php echo esc_html( $fv_category['text'] ); ?></p>
							<a class="fv-link-arrow mt-5" href="<?php echo esc_url( fv_get_shop_url() ); ?>">
								<?php esc_html_e( 'Explorar', 'fauna-del-velazco' ); ?>
								<?php echo fv_icon( 'arrow-up-right', 'h-4 w-4' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</a>
						</article>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</section>

	<section id="nosotros" class="fv-section border-y border-forest/15 bg-paper/60">
		<div class="fv-container grid items-center gap-14 lg:grid-cols-[0.85fr_1.15fr] lg:gap-20">
			<div class="relative mx-auto w-full max-w-sm">
				<div class="fv-arch flex aspect-[4/5] flex-col items-center justify-center bg-sage-soft/55 px-8 text-center">
					<span class="font-display text-[7rem] leading-none text-forest">VB</span>
					<span class="mt-5 text-xs font-bold uppercase tracking-[0.2em] text-forest/60"><?php esc_html_e( 'Dra. Victoria Boratto', 'fauna-del-velazco' ); ?></span>
					<span class="mt-1 text-xs text-forest/45"><?php esc_html_e( 'Médica Veterinaria', 'fauna-del-velazco' ); ?></span>
				</div>
				<img class="absolute -right-8 -top-6 h-56 w-auto text-sage/70" src="<?php echo esc_url( FV_URI . '/assets/img/botanical-branch.svg' ); ?>" alt="" width="220" height="360" loading="lazy" decoding="async">
				<div class="absolute -bottom-6 -left-4 max-w-[13rem] border border-forest/15 bg-cream p-4 shadow-soft">
					<p class="text-[0.62rem] font-bold uppercase tracking-[0.18em] text-terracotta-ink"><?php esc_html_e( 'Atención personalizada', 'fauna-del-velazco' ); ?></p>
					<p class="mt-2 text-xs leading-relaxed text-forest/65"><?php esc_html_e( 'Una sola profesional para acompañar cada etapa.', 'fauna-del-velazco' ); ?></p>
				</div>
			</div>

			<div>
				<p class="fv-eyebrow"><?php esc_html_e( 'La clínica', 'fauna-del-velazco' ); ?></p>
				<h2 class="fv-display fv-display--md mt-4"><?php esc_html_e( 'Una mirada cercana, sin apuro.', 'fauna-del-velazco' ); ?></h2>
				<p class="fv-lead mt-6">
					<?php esc_html_e( 'Fauna del Velazco nace para acompañar a las familias y a sus animales con una atención personalizada. Cada consulta empieza escuchando: qué cambió, cómo vive tu mascota y qué necesita para estar mejor.', 'fauna-del-velazco' ); ?>
				</p>
				<blockquote class="fv-detail mt-8 font-display text-2xl leading-snug text-forest">
					<span class="mb-1 block font-display text-4xl leading-none text-terracotta" aria-hidden="true">&ldquo;</span>
					<?php esc_html_e( 'La medicina veterinaria también es escuchar.', 'fauna-del-velazco' ); ?>
				</blockquote>
				<ul class="mt-8 space-y-3 text-sm text-forest/70">
					<li class="flex items-start gap-3">
						<?php echo fv_icon( 'check', 'mt-0.5 h-4 w-4 shrink-0 text-terracotta' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<?php esc_html_e( 'Consultas con tiempo para explicar y resolver dudas.', 'fauna-del-velazco' ); ?>
					</li>
					<li class="flex items-start gap-3">
						<?php echo fv_icon( 'check', 'mt-0.5 h-4 w-4 shrink-0 text-terracotta' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<?php esc_html_e( 'Seguimiento de vacunas y controles preventivos.', 'fauna-del-velazco' ); ?>
					</li>
					<li class="flex items-start gap-3">
						<?php echo fv_icon( 'check', 'mt-0.5 h-4 w-4 shrink-0 text-terracotta' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<?php esc_html_e( 'Un espacio tranquilo para animales y personas.', 'fauna-del-velazco' ); ?>
					</li>
				</ul>
			</div>
		</div>
	</section>

	<section id="preguntas" class="fv-section">
		<div class="fv-container grid gap-12 lg:grid-cols-[0.75fr_1.25fr] lg:gap-20">
			<div>
				<p class="fv-eyebrow"><?php esc_html_e( 'Preguntas frecuentes', 'fauna-del-velazco' ); ?></p>
				<h2 class="fv-display fv-display--md mt-4"><?php esc_html_e( 'Antes de tu visita.', 'fauna-del-velazco' ); ?></h2>
				<p class="fv-lead mt-6"><?php esc_html_e( 'Si te queda una duda, escribinos. Preferimos responder antes de que llegues.', 'fauna-del-velazco' ); ?></p>
			</div>
			<div>
				<details class="fv-faq" open>
					<summary>
						<span><?php esc_html_e( '¿Cómo reservo un turno?', 'fauna-del-velazco' ); ?></span>
						<?php echo fv_icon( 'plus', 'h-5 w-5' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</summary>
					<div class="fv-faq__answer"><?php esc_html_e( 'Elegí el servicio, la mascota y el horario disponible. Si es tu primera vez, podés crear tu cuenta durante el proceso.', 'fauna-del-velazco' ); ?></div>
				</details>
				<details class="fv-faq">
					<summary>
						<span><?php esc_html_e( '¿Cómo se paga la seña?', 'fauna-del-velazco' ); ?></span>
						<?php echo fv_icon( 'plus', 'h-5 w-5' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</summary>
					<div class="fv-faq__answer"><?php esc_html_e( 'La seña se paga online con Mercado Pago. El turno queda confirmado cuando el pago se acredita.', 'fauna-del-velazco' ); ?></div>
				</details>
				<details class="fv-faq">
					<summary>
						<span><?php esc_html_e( '¿Atienden urgencias?', 'fauna-del-velazco' ); ?></span>
						<?php echo fv_icon( 'plus', 'h-5 w-5' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</summary>
					<div class="fv-faq__answer"><?php esc_html_e( 'Escribinos por WhatsApp y te orientamos. Si es una urgencia fuera del horario, buscá atención veterinaria inmediata.', 'fauna-del-velazco' ); ?></div>
				</details>
				<details class="fv-faq">
					<summary>
						<span><?php esc_html_e( '¿Puedo comprar sin reservar un turno?', 'fauna-del-velazco' ); ?></span>
						<?php echo fv_icon( 'plus', 'h-5 w-5' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</summary>
					<div class="fv-faq__answer"><?php esc_html_e( 'Sí. La tienda funciona con WooCommerce y podés comprar alimentos y accesorios por separado.', 'fauna-del-velazco' ); ?></div>
				</details>
			</div>
		</div>
	</section>

	<section id="contacto" class="fv-section bg-forest text-cream">
		<div class="fv-container grid gap-12 lg:grid-cols-[1.1fr_0.9fr] lg:gap-20">
			<div>
				<p class="fv-eyebrow text-sage-soft"><?php esc_html_e( 'Contacto', 'fauna-del-velazco' ); ?></p>
				<h2 class="fv-display fv-display--md fv-display--light mt-4"><?php esc_html_e( 'Hablemos de tu mascota.', 'fauna-del-velazco' ); ?></h2>
				<p class="fv-lead fv-lead--light mt-6"><?php esc_html_e( 'Escribinos para coordinar una visita o resolver una duda. También podés usar el chat flotante de WhatsApp.', 'fauna-del-velazco' ); ?></p>
				<div class="mt-8 flex flex-wrap gap-3">
					<a class="fv-btn fv-btn--light" href="<?php echo esc_url( fv_get_booking_url() ); ?>">
						<?php esc_html_e( 'Reservar turno', 'fauna-del-velazco' ); ?>
						<?php echo fv_icon( 'arrow-right', 'h-4 w-4' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</a>
					<?php if ( fv_has_whatsapp() ) : ?>
						<a class="fv-btn fv-btn--ghost border-cream/25 text-cream hover:bg-cream hover:text-forest" href="<?php echo esc_url( fv_get_whatsapp_url() ); ?>" target="_blank" rel="noopener noreferrer">
							<?php echo fv_icon( 'whatsapp', 'h-4 w-4' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<?php esc_html_e( 'WhatsApp', 'fauna-del-velazco' ); ?>
						</a>
					<?php endif; ?>
				</div>
			</div>

			<div class="border border-cream/15 p-6 sm:p-8">
				<ul class="space-y-5 text-sm">
					<li class="flex gap-4">
						<?php echo fv_icon( 'map-pin', 'mt-0.5 h-5 w-5 shrink-0 text-sage-soft' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<div>
							<p class="text-[0.65rem] font-bold uppercase tracking-[0.18em] text-cream/60"><?php esc_html_e( 'Dirección', 'fauna-del-velazco' ); ?></p>
							<p class="mt-1 text-cream/85"><?php echo esc_html( fv_get_address() ); ?></p>
						</div>
					</li>
					<li class="flex gap-4">
						<?php echo fv_icon( 'clock', 'mt-0.5 h-5 w-5 shrink-0 text-sage-soft' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<div>
							<p class="text-[0.65rem] font-bold uppercase tracking-[0.18em] text-cream/60"><?php esc_html_e( 'Horarios', 'fauna-del-velazco' ); ?></p>
							<p class="mt-1 text-cream/85"><?php echo esc_html( fv_get_hours() ); ?></p>
						</div>
					</li>
					<li class="flex gap-4">
						<?php echo fv_icon( 'calendar', 'mt-0.5 h-5 w-5 shrink-0 text-sage-soft' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<div>
							<p class="text-[0.65rem] font-bold uppercase tracking-[0.18em] text-cream/60"><?php esc_html_e( 'Turnos', 'fauna-del-velazco' ); ?></p>
							<p class="mt-1 text-cream/85"><?php esc_html_e( 'Reserva online con seña.', 'fauna-del-velazco' ); ?></p>
						</div>
					</li>
					<?php if ( fv_get_phone() ) : ?>
						<li class="flex gap-4">
							<?php echo fv_icon( 'phone', 'mt-0.5 h-5 w-5 shrink-0 text-sage-soft' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<div>
								<p class="text-[0.65rem] font-bold uppercase tracking-[0.18em] text-cream/60"><?php esc_html_e( 'Teléfono', 'fauna-del-velazco' ); ?></p>
								<a class="mt-1 block text-cream/85" href="<?php echo esc_url( fv_get_phone_href() ); ?>"><?php echo esc_html( fv_get_phone() ); ?></a>
							</div>
						</li>
					<?php endif; ?>
					<?php if ( fv_get_email() ) : ?>
						<li class="flex gap-4">
							<?php echo fv_icon( 'mail', 'mt-0.5 h-5 w-5 shrink-0 text-sage-soft' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<div>
								<p class="text-[0.65rem] font-bold uppercase tracking-[0.18em] text-cream/60"><?php esc_html_e( 'Email', 'fauna-del-velazco' ); ?></p>
								<a class="mt-1 block text-cream/85" href="mailto:<?php echo esc_attr( fv_get_email() ); ?>"><?php echo esc_html( fv_get_email() ); ?></a>
							</div>
						</li>
					<?php endif; ?>
				</ul>
			</div>
		</div>
	</section>

</main>
<?php
get_footer();
