<?php
/**
 * Plugin Name: Maintenance Mode
 * Plugin URI: https://vip.wordpress.com/plugins/maintenance-mode/
 * Description: Shut down your site for a little while and do some maintenance on it!
 * Author: Automattic / WordPress.com VIP
 * Author URI: https://vip.wordpress.com
 * Version: 0.1.0
 * License: GPLv2
 *
 * Usage:
 * - Add a template to your theme's root folder called `template-maintenance-mode.php`.
 * - This should be a simple HTML page that should include the message you want to show your visitors.
 * - Note: the template should include `wp_head()` and `wp_footer()` calls.
 * - Add the VIP_MAINTENANCE_MODE constant to your theme and set to `true`.
 */

if ( defined( 'VIP_MAINTENANCE_MODE' ) && true === VIP_MAINTENANCE_MODE ) {
	add_action( 'template_redirect', function() {
		$required_capability = apply_filters( 'vip_maintenance_mode_reqiured_cap', 'edit_posts' );
		if ( current_user_can( $required_capability ) ) {
			return;
		}

		// Prevents search engines to index the content of the maintenance page.
		$respond_503 = apply_filters( 'vip_maintenance_mode_respond_503', true );

		if ( true === $respond_503 ) {
			status_header( 503 );

			// Indicates how long the service is expected to be unavailable.
			// Accepts a value in seconds or an http-date.
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
