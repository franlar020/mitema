<?php
/**
 * 404 template.
 *
 * @package FaunaDelVelazco
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main id="primary" class="fv-main">
	<section class="fv-container fv-section text-center">
		<p class="fv-eyebrow"><?php esc_html_e( 'Error 404', 'fauna-del-velazco' ); ?></p>
		<h1 class="fv-display mx-auto mt-4 max-w-4xl"><?php esc_html_e( 'Esta página se fue a pasear.', 'fauna-del-velazco' ); ?></h1>
		<p class="fv-lead mx-auto mt-6">
			<?php esc_html_e( 'No encontramos lo que buscabas. Podés volver al inicio o escribirnos para que te ayudemos.', 'fauna-del-velazco' ); ?>
		</p>
		<div class="mt-8 flex flex-wrap justify-center gap-3">
			<a class="fv-btn fv-btn--primary" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php esc_html_e( 'Volver al inicio', 'fauna-del-velazco' ); ?>
				<?php echo fv_icon( 'arrow-right', 'h-4 w-4' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</a>
			<a class="fv-btn fv-btn--ghost" href="<?php echo esc_url( fv_get_booking_url() ); ?>">
				<?php esc_html_e( 'Reservar un turno', 'fauna-del-velazco' ); ?>
			</a>
		</div>
	</section>
</main>
<?php
get_footer();
