<?php
/**
 * Single post template.
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
					<p class="fv-eyebrow"><?php echo esc_html( get_the_date() ); ?></p>
					<h1 class="fv-display fv-display--md mt-4"><?php the_title(); ?></h1>
					<p class="mt-5 text-sm text-forest/55">
						<?php
						printf(
							/* translators: %s: author name. */
							esc_html__( 'Por %s', 'fauna-del-velazco' ),
							esc_html( get_the_author() )
						);
						?>
					</p>
				</div>
			</header>

			<?php if ( has_post_thumbnail() ) : ?>
				<div class="fv-container pt-12">
					<div class="fv-arch overflow-hidden">
						<?php the_post_thumbnail( 'fv-hero', array( 'class' => 'h-auto w-full object-cover' ) ); ?>
					</div>
				</div>
			<?php endif; ?>

			<div class="fv-container fv-section">
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

				<?php
				the_post_navigation(
					array(
						'prev_text' => '<span class="text-xs uppercase tracking-wider text-forest/50">' . esc_html__( 'Anterior', 'fauna-del-velazco' ) . '</span><span class="mt-1 block text-forest">%title</span>',
						'next_text' => '<span class="text-xs uppercase tracking-wider text-forest/50">' . esc_html__( 'Siguiente', 'fauna-del-velazco' ) . '</span><span class="mt-1 block text-forest">%title</span>',
						'class'     => 'mt-16 grid gap-6 border-t border-forest/15 pt-8 sm:grid-cols-2',
					)
				);
				?>

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
