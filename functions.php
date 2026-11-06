<?php
/**
 * Fauna del Velazco theme bootstrap.
 *
 * @package FaunaDelVelazco
 */

defined( 'ABSPATH' ) || exit;

define( 'FV_VERSION', '0.1.0' );
define( 'FV_DIR', get_template_directory() );
define( 'FV_URI', get_template_directory_uri() );

require_once FV_DIR . '/inc/setup.php';
require_once FV_DIR . '/inc/enqueue.php';
require_once FV_DIR . '/inc/logo.php';
require_once FV_DIR . '/inc/template-tags.php';
require_once FV_DIR . '/inc/nav.php';
require_once FV_DIR . '/inc/customizer.php';
require_once FV_DIR . '/inc/woocommerce.php';
