<?php
/**
 * Search form.
 *
 * @package FaunaDelVelazco
 */

defined( 'ABSPATH' ) || exit;

$fv_search_id = 'fv-search-' . wp_unique_id();
?>
<form role="search" method="get" class="fv-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="sr-only" for="<?php echo esc_attr( $fv_search_id ); ?>"><?php esc_html_e( 'Buscar', 'fauna-del-velazco' ); ?></label>
	<div class="flex flex-col gap-3 sm:flex-row">
		<input
			id="<?php echo esc_attr( $fv_search_id ); ?>"
			type="search"
			name="s"
			value="<?php echo esc_attr( get_search_query() ); ?>"
			placeholder="<?php esc_attr_e( 'Buscar en el sitio…', 'fauna-del-velazco' ); ?>"
			class="min-h-11 w-full border border-forest/20 bg-cream px-4 text-sm text-forest placeholder:text-forest/40 focus:border-forest focus:outline-none"
		>
		<button class="fv-btn fv-btn--primary shrink-0" type="submit">
			<?php echo fv_icon( 'search', 'h-4 w-4' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<?php esc_html_e( 'Buscar', 'fauna-del-velazco' ); ?>
		</button>
	</div>
</form>
