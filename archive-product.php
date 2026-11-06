<?php
/**
 * Product archive.
 *
 * @package FaunaDelVelazco
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<?php do_action( 'woocommerce_before_main_content' ); ?>
	<header class="fv-woocommerce-products-header">
		<p class="fv-eyebrow"><?php esc_html_e( 'Tienda', 'fauna-del-velazco' ); ?></p>
		<h1 class="fv-woocommerce-products-header__title page-title"><?php echo esc_html( woocommerce_page_title( false ) ); ?></h1>
	</header>

	<?php do_action( 'woocommerce_archive_description' ); ?>

	<?php do_action( 'woocommerce_before_shop_loop' ); ?>
	<div class="mt-12 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php
				$fv_product_id = get_the_ID();
				$fv_product    = wc_get_product( $fv_product_id );
				?>
				<article class="fv-product group">
					<a class="fv-product__media" href="<?php echo esc_url( get_permalink( $fv_product_id ) ); ?>">
						<?php
						$fv_image = get_the_post_thumbnail(
							$fv_product_id,
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
							<h2 class="font-display text-xl text-forest">
								<a class="no-underline" href="<?php echo esc_url( get_permalink( $fv_product_id ) ); ?>"><?php echo esc_html( get_the_title( $fv_product_id ) ); ?></a>
							</h2>
							<div class="mt-1 text-sm text-forest/60">
								<?php echo $fv_product ? wp_kses_post( $fv_product->get_price_html() ) : ''; ?>
							</div>
						</div>
						<?php if ( $fv_product && $fv_product->is_add_to_cart_enabled() ) : ?>
							<?php echo apply_filters( 'woocommerce_add_to_cart_button', woocommerce_add_to_cart_button( $fv_product_id ), $fv_product ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<?php endif; ?>
					</div>
				</article>
			<?php endwhile; ?>
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
	<?php do_action( 'woocommerce_after_shop_loop' ); ?>
	<?php the_posts_navigation(); ?>
<?php do_action( 'woocommerce_after_main_content' ); ?>
<?php
get_footer();
