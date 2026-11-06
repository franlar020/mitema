<?php
/**
 * Fallback template.
 *
 * @package FaunaDelVelazco
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main id="primary" class="fv-main">
	<header class="fv-page-hero">
		<div class="fv-container">
			<p class="fv-eyebrow"><?php esc_html_e( 'Notas', 'fauna-del-velazco' ); ?></p>
			<h1 class="fv-display fv-display--md mt-4"><?php esc_html_e( 'Historias y cuidados.', 'fauna-del-velazco' ); ?></h1>
		</div>
	</header>

	<div class="fv-container fv-section">
		<?php if ( have_posts() ) : ?>
			<div class="grid gap-12 sm:grid-cols-2 lg:grid-cols-3">
				<?php while ( have_posts() ) : ?>
					<?php the_post(); ?>
					<?php get_template_part( 'template-parts/content', 'card' ); ?>
				<?php endwhile; ?>
			</div>

			<?php
			the_posts_pagination(
				array(
					'mid_size'  => 2,
					'prev_text' => esc_html__( 'Anterior', 'fauna-del-velazco' ),
					'next_text' => esc_html__( 'Siguiente', 'fauna-del-velazco' ),
					'class'     => 'fv-pagination mt-16',
				)
			);
			?>
		<?php else : ?>
			<?php get_template_part( 'template-parts/content', 'none' ); ?>
		<?php endif; ?>
	</div>
</main>
<?php
get_footer();
