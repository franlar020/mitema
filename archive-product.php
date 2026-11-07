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
		<p class="fv-eyebrow"><?php esc_html_e( 'Catálogo', 'fauna-del-velazco' ); ?></p>
		<h1 class="fv-woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
		<?php do_action( 'woocommerce_archive_description' ); ?>
	</header>

	<?php
	$fv_categories = get_terms(
		array(
			'taxonomy'   => 'product_cat',
			'hide_empty' => true,
		)
	);
	?>

	<?php if ( ! is_wp_error( $fv_categories ) && ! empty( $fv_categories ) ) : ?>
		<nav class="fv-shop-categories" aria-label="<?php esc_attr_e( 'Categorías de productos', 'fauna-del-velazco' ); ?>">
			<a class="fv-shop-categories__link<?php echo is_shop() ? ' is-current' : ''; ?>" href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>"<?php echo is_shop() ? ' aria-current="page"' : ''; ?>>
				<?php esc_html_e( 'Todos', 'fauna-del-velazco' ); ?>
			</a>
			<?php foreach ( $fv_categories as $fv_category ) : ?>
				<a class="fv-shop-categories__link<?php echo is_product_category( $fv_category->slug ) ? ' is-current' : ''; ?>" href="<?php echo esc_url( get_term_link( $fv_category ) ); ?>"<?php echo is_product_category( $fv_category->slug ) ? ' aria-current="page"' : ''; ?>>
					<?php echo esc_html( $fv_category->name ); ?>
				</a>
			<?php endforeach; ?>
		</nav>
	<?php endif; ?>

	<div class="fv-shop-toolbar">
		<?php do_action( 'woocommerce_before_shop_loop' ); ?>
	</div>

	<?php if ( have_posts() ) : ?>
		<div class="fv-product-grid">
			<?php
			while ( have_posts() ) :
				the_post();

				$fv_product = wc_get_product( get_the_ID() );

				if ( ! $fv_product ) {
					continue;
				}

				wc_setup_product_data( get_the_ID() );

				$fv_image = fv_imagen_producto_html(
					get_the_ID(),
					'fv-card',
					array(
						'class'   => 'h-full w-full object-cover transition duration-500 group-hover:scale-105',
						'loading' => 'lazy',
					)
				);
				?>
				<article <?php wc_product_class( 'fv-product group', $fv_product ); ?>>
					<a class="fv-product__media" href="<?php echo esc_url( get_permalink() ); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'Ver %s', 'fauna-del-velazco' ), $fv_product->get_name() ) ); ?>">
						<?php if ( $fv_image ) : ?>
							<?php echo wp_kses_post( $fv_image ); ?>
						<?php else : ?>
							<span class="fv-product__placeholder">
								<?php echo fv_icon( 'paw', 'h-12 w-12' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								<span class="fv-product__placeholder-text"><?php esc_html_e( 'Imagen próximamente', 'fauna-del-velazco' ); ?></span>
							</span>
						<?php endif; ?>

						<?php if ( ! $fv_product->is_in_stock() ) : ?>
							<span class="fv-product__badge fv-product__badge--out"><?php esc_html_e( 'Sin stock', 'fauna-del-velazco' ); ?></span>
						<?php elseif ( $fv_product->is_on_sale() ) : ?>
							<span class="fv-product__badge"><?php esc_html_e( 'Oferta', 'fauna-del-velazco' ); ?></span>
						<?php endif; ?>
					</a>

					<div class="fv-product__body">
						<?php echo wp_kses_post( wc_get_product_category_list( get_the_ID(), ' · ', '<p class="fv-product__category">', '</p>' ) ); ?>

						<h2 class="fv-product__title">
							<a class="no-underline" href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_html( $fv_product->get_name() ); ?></a>
						</h2>

						<div class="fv-product__price">
							<?php echo wp_kses_post( $fv_product->get_price_html() ); ?>
						</div>

						<div class="fv-product__actions">
							<?php woocommerce_template_loop_add_to_cart(); ?>
						</div>
					</div>
				</article>
			<?php endwhile; ?>
		</div>

		<?php do_action( 'woocommerce_after_shop_loop' ); ?>
	<?php else : ?>
		<div class="fv-shop-empty">
			<p class="fv-eyebrow"><?php esc_html_e( 'Catálogo en preparación', 'fauna-del-velazco' ); ?></p>
			<h2 class="mt-4 font-display text-3xl text-forest"><?php esc_html_e( 'Todavía no hay productos publicados.', 'fauna-del-velazco' ); ?></h2>
			<p class="mt-4 max-w-xl text-sm leading-relaxed text-forest/65"><?php esc_html_e( 'Estamos cargando el catálogo de alimentos, accesorios y productos de cuidado. Mientras tanto, podés consultarnos por WhatsApp.', 'fauna-del-velazco' ); ?></p>
			<a class="fv-btn fv-btn--primary mt-8" href="<?php echo esc_url( fv_get_whatsapp_url() ); ?>">
				<?php echo fv_icon( 'whatsapp', 'h-4 w-4' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<?php esc_html_e( 'Consultar por WhatsApp', 'fauna-del-velazco' ); ?>
			</a>
		</div>
	<?php endif; ?>
<?php do_action( 'woocommerce_after_main_content' ); ?>
<?php
get_footer();
