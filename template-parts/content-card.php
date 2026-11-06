<?php
/**
 * Post card used in archives and search results.
 *
 * @package FaunaDelVelazco
 */

defined( 'ABSPATH' ) || exit;
?>
<article <?php post_class( 'fv-post-card group' ); ?>>
	<a class="fv-post-card__media" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'fv-card', array( 'class' => 'h-full w-full object-cover transition duration-500 group-hover:scale-105', 'loading' => 'lazy' ) ); ?>
		<?php else : ?>
			<span class="flex h-full items-center justify-center text-forest/30"><?php echo fv_icon( 'leaf', 'h-12 w-12' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
		<?php endif; ?>
	</a>

	<div class="mt-5">
		<p class="fv-eyebrow"><?php echo esc_html( get_the_date() ); ?></p>
		<h2 class="mt-3 font-display text-2xl leading-tight text-forest">
			<a class="no-underline" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h2>
		<p class="mt-3 text-sm leading-relaxed text-forest/60"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 24 ) ); ?></p>
		<a class="fv-link-arrow mt-5" href="<?php the_permalink(); ?>">
			<?php esc_html_e( 'Leer nota', 'fauna-del-velazco' ); ?>
			<?php echo fv_icon( 'arrow-up-right', 'h-4 w-4' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</a>
	</div>
</article>
