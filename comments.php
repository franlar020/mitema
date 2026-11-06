<?php
/**
 * Comments template.
 *
 * @package FaunaDelVelazco
 */

defined( 'ABSPATH' ) || exit;

if ( post_password_required() ) {
	return;
}
?>
<div id="comments" class="fv-comments">
	<?php if ( have_comments() ) : ?>
		<h2 class="fv-display fv-display--sm">
			<?php
			$fv_comment_count = get_comments_number();
			printf(
				/* translators: %s: comment count. */
				esc_html( _n( '%s comentario', '%s comentarios', $fv_comment_count, 'fauna-del-velazco' ) ),
				esc_html( number_format_i18n( $fv_comment_count ) )
			);
			?>
		</h2>

		<ol class="mt-8 space-y-8">
			<?php
			wp_list_comments(
				array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 48,
				)
			);
			?>
		</ol>

		<?php the_comments_navigation(); ?>
	<?php endif; ?>

	<?php if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="mt-8 text-sm text-forest/55"><?php esc_html_e( 'Los comentarios están cerrados.', 'fauna-del-velazco' ); ?></p>
	<?php endif; ?>

	<div class="mt-12">
		<?php comment_form(); ?>
	</div>
</div>
