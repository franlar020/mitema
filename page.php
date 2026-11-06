<?php
/**
 * Page template.
 *
 * @package FaunaDelVelazco
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main id="primary" class="fv-main">
	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>
		<article <?php post_class(); ?>>
			<header class="fv-page-hero">
				<div class="fv-container">
					<p class="fv-eyebrow"><?php esc_html_e( 'Fauna del Velazco', 'fauna-del-velazco' ); ?></p>
					<h1 class="fv-display fv-display--md mt-4"><?php the_title(); ?></h1>
				</div>
			</header>

			<div class="fv-container fv-section">
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="fv-arch mb-12 overflow-hidden">
						<?php the_post_thumbnail( 'fv-hero', array( 'class' => 'h-auto w-full object-cover' ) ); ?>
					</div>
				<?php endif; ?>

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
			</div>
		</article>
	<?php endwhile; ?>
</main>
<?php
get_footer();
