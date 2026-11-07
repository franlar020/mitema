<?php
/**
 * Page template.
 *
 * @package FaunaDelVelazco
 */

defined( 'ABSPATH' ) || exit;

get_header();

$fv_is_wc_page = function_exists( 'is_cart' ) && ( is_cart() || is_checkout() || is_account_page() );
$fv_wc_eyebrow = __( 'Fauna del Velazco', 'fauna-del-velazco' );

if ( $fv_is_wc_page ) {
	if ( is_account_page() ) {
		$fv_wc_eyebrow = __( 'Mi cuenta', 'fauna-del-velazco' );
	} elseif ( is_checkout() ) {
		$fv_wc_eyebrow = __( 'Compra', 'fauna-del-velazco' );
	} else {
		$fv_wc_eyebrow = __( 'Tienda', 'fauna-del-velazco' );
	}
}
?>
<main id="primary" class="fv-main">
	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>
		<article <?php post_class(); ?>>
			<header class="fv-page-hero<?php echo $fv_is_wc_page ? ' fv-page-hero--compact' : ''; ?>">
				<div class="fv-container">
					<p class="fv-eyebrow"><?php echo esc_html( $fv_wc_eyebrow ); ?></p>
					<h1 class="fv-display fv-display--md mt-4"><?php the_title(); ?></h1>
				</div>
			</header>

			<div class="fv-container <?php echo $fv_is_wc_page ? 'fv-woocommerce-main py-10 sm:py-14' : 'fv-section'; ?>">
				<?php if ( has_post_thumbnail() && ! $fv_is_wc_page ) : ?>
					<div class="fv-arch mb-12 overflow-hidden">
						<?php the_post_thumbnail( 'fv-hero', array( 'class' => 'h-auto w-full object-cover' ) ); ?>
					</div>
				<?php endif; ?>

				<?php if ( $fv_is_wc_page ) : ?>
					<div class="fv-woocommerce-page">
						<?php the_content(); ?>
					</div>
				<?php else : ?>
					<div class="fv-prose">
						<?php the_content(); ?>
						<?php
						wp_link_pages(
							array(
								'before' => '<div class="fv-page-links">' . esc_html__( 'Páginas:', 'fauna-del-velazco' ),
								'after'  => '</div>',
							)
						);
						?>
					</div>

					<?php if ( comments_open() || get_comments_number() ) : ?>
						<div class="mt-16">
							<?php comments_template(); ?>
						</div>
					<?php endif; ?>
				<?php endif; ?>
			</div>
		</article>
	<?php endwhile; ?>
</main>
<?php
get_footer();
