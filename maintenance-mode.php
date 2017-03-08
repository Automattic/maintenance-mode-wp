<?php
/**
 * Plugin Name: Maintenance Mode
 * Plugin URI: https://vip.wordpress.com/plugins/maintenance-mode/
 * Description: Shut down your site for a little while and do some maintenance on it!
 * Author: Automattic / WordPress.com VIP
 * Author URI: https://vip.wordpress.com
 * Version: 0.1.0
 * License: GPLv2
 * Text Domain: maintenance-mode
 * Domain Path: /languages
 *
 * Usage:
 * - Add a template to your theme's root folder called `template-maintenance-mode.php`.
 * - This should be a simple HTML page that should include the message you want to show your visitors.
 * - Note: the template should include `wp_head()` and `wp_footer()` calls.
 * - Add the VIP_MAINTENANCE_MODE constant to your theme and set to `true`.
 */

if ( defined( 'VIP_MAINTENANCE_MODE' ) && true === VIP_MAINTENANCE_MODE ) {
	add_action( 'template_redirect', function() {
		$required_capability = apply_filters( 'vip_maintenance_mode_required_cap', 'edit_posts' );
		if ( current_user_can( $required_capability ) ) {
			return;
		}

		/**
		 * Filters wether to respond with a 503 status code.
		 *
		 * The 503 status code prevents search engines to index the content of the maintenance page.
		 *
		 * @since 0.1.1
		 *
		 * @param bool $bool Whether to respond with a 503 status code. Default true.
		 */
		$respond_503 = apply_filters( 'vip_maintenance_mode_respond_503', true );

		if ( true === $respond_503 ) {
			status_header( 503 );

			/**
			 * Filters the Retry-After value used to indicate how long the service is expected to be unavailable.
			 *
			 * @since 0.1.1
			 *
			 * @param int|string The delay in seconds or an http-date. Default to one hour.
			 */
			$retry_after = apply_filters( 'vip_maintenance_mode_retry_after', 3600 );

			if ( is_int( $retry_after ) ) {
				header( 'Retry-After: ' . absint( $retry_after ) );
			} elseif ( strtotime( $retry_after ) > time() ) {
				header( 'Retry-After: ' . gmdate( 'D, d M Y H:i:s T', strtotime( $retry_after ) ) );
			}
		}

		if ( locate_template( 'template-maintenance-mode.php' ) ) {
			get_template_part( 'template-maintenance-mode' );
		} else {
			include( __DIR__ . '/template-maintenance-mode.php' );
		}
		exit;
	} );
}

/**
 * Localize plugin
 *
 * @since 0.1.1
 * @uses load_plugin_textdomain
 * @return void
 */
function vip_maintenance_mode_load_plugin_textdomain() {
	load_plugin_textdomain( 'maintenance-mode', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
}
add_action( 'init', 'vip_maintenance_mode_load_plugin_textdomain' );
