<?php
/**
 * Single product.
 *
 * @package FaunaDelVelazco
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<?php do_action( 'woocommerce_before_main_content' ); ?>
	<?php do_action( 'woocommerce_before_single_product' ); ?>

	<?php
	while ( have_posts() ) :
		the_post();

		$fv_product = wc_get_product( get_the_ID() );

		if ( ! $fv_product ) {
			continue;
		}

		$fv_catalog_url    = fv_url_imagen_catalogo( $fv_product->get_sku() );
		$fv_attachment_id  = '' !== $fv_catalog_url ? fv_attachment_id_desde_url( $fv_catalog_url ) : 0;
		$fv_has_native_img = $fv_attachment_id || $fv_product->get_image_id();
		?>
		<article id="product-<?php the_ID(); ?>" <?php wc_product_class( 'fv-single-product', $fv_product ); ?>>
			<div class="fv-single-product__grid">
				<div class="fv-single-product__media">
					<?php woocommerce_show_product_sale_flash(); ?>

					<?php if ( $fv_has_native_img ) : ?>
						<?php woocommerce_show_product_images(); ?>
					<?php elseif ( '' !== $fv_catalog_url ) : ?>
						<div class="fv-single-product__image">
							<?php
							echo wp_kses_post(
								fv_imagen_producto_html(
									get_the_ID(),
									'full',
									array(
										'class' => 'h-auto w-full object-cover',
										'alt'   => $fv_product->get_name(),
									)
								)
							);
							?>
						</div>
					<?php else : ?>
						<div class="fv-single-product__image">
							<img class="h-auto w-full object-cover" src="<?php echo esc_url( fv_placeholder_producto() ); ?>" alt="<?php echo esc_attr( $fv_product->get_name() ); ?>" loading="lazy">
						</div>
					<?php endif; ?>
				</div>

				<div class="fv-single-product__info">
					<?php do_action( 'woocommerce_single_product_summary' ); ?>
				</div>
			</div>

			<?php do_action( 'woocommerce_after_single_product_summary' ); ?>
		</article>

		<?php do_action( 'woocommerce_after_single_product' ); ?>
	<?php endwhile; ?>
<?php do_action( 'woocommerce_after_main_content' ); ?>
<?php
get_footer();
