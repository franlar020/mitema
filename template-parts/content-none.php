<?php
/**
 * Empty state for archives and search results.
 *
 * @package FaunaDelVelazco
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="fv-empty">
	<span class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-sage-soft/50 text-forest">
		<?php echo fv_icon( 'search', 'h-6 w-6' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</span>
	<p class="fv-eyebrow mt-6"><?php esc_html_e( 'Sin resultados', 'fauna-del-velazco' ); ?></p>
	<h2 class="fv-display fv-display--sm mt-3"><?php esc_html_e( 'No encontramos nada por acá.', 'fauna-del-velazco' ); ?></h2>
	<p class="mx-auto mt-4 max-w-md text-sm leading-relaxed text-forest/60">
		<?php esc_html_e( 'Probá con otra búsqueda o volvé al inicio para seguir explorando.', 'fauna-del-velazco' ); ?>
	</p>
	<div class="mx-auto mt-6 max-w-md">
		<?php get_search_form(); ?>
	</div>
</div>
