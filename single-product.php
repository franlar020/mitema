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
	<?php do_action( 'woocommerce_breadcrumb' ); ?>

	<?php do_action( 'woocommerce_before_single_product' ); ?>
	<article id="product-<?php echo get_the_ID(); ?>" class="product type-product">
		<div class="grid gap-12 lg:grid-cols-2 lg:gap-20">
			<div class="fv-single-product__media">
				<?php do_action( 'woocommerce_before_single_product_media' ); ?>
				<?php
				the_post_thumbnail(
					'fv-card',
					array(
						'class'   => 'aspect-[4/5] w-full rounded-[2rem] border border-forest/15 bg-cream object-cover shadow-soft',
						'loading' => 'lazy',
						'alt'     => get_the_title(),
					)
				);
				?>
				<?php do_action( 'woocommerce_after_single_product_media' ); ?>
			</div>

			<div class="fv-single-product__info">
				<?php do_action( 'woocommerce_single_product_summary' ); ?>
			</div>
		</div>
	</article>
	<?php do_action( 'woocommerce_after_single_product' ); ?>
<?php do_action( 'woocommerce_after_main_content' ); ?>
<?php
get_footer();
