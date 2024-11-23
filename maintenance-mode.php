<?php
/**
 * Maintenance Mode
 *
 * @package           Automattic/MaintenanceMode
 * @author            Automattic
 * @copyright         2008-onwards Automattic, and contributors.
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       Maintenance Mode
 * Plugin URI:        https://github.com/Automattic/maintenance-mode-wp
 * Description:       Shut down your site for a little while and do some maintenance on it!
 * Version:           0.2.2
 * Requires at least: 5.9
 * Requires PHP:      7.4
 * Author:            WordPress VIP, Automattic
 * Author URI:        https://wpvip.com
 * Text Domain:       maintenance-mode
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

// Stops the execution early if the VIP_MAINTENANCE_MODE constant is not set to `true`.
if ( ! defined( 'VIP_MAINTENANCE_MODE' ) || true !== VIP_MAINTENANCE_MODE ) {
	add_action( 'admin_notices', 'vip_maintenance_mode_admin_notice__constant_not_set' );
	return;
}

/**
 * Displays a warning in the admin to inform users about the VIP_MAINTENANCE_MODE constant
 *
 * Only users who can activate plugins will see the warning.
 *
 * @since 0.1.1
 */
function vip_maintenance_mode_admin_notice__constant_not_set() {
	if ( ! current_user_can( 'activate_plugins' ) ) {
		return;
	}

	$class   = 'notice notice-warning';
	$message = __( 'Maintenance Mode won\'t work until you set the VIP_MAINTENANCE_MODE constant to <code>true</code>.', 'maintenance-mode' );
	printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), wp_kses( $message, array( 'code' => array() ) ) );
}

/**
 * Checks to see if the current user can bypass maintenance mode
 */
function vip_maintenance_mode_current_user_can_bypass() {
	/**
	 * Filters the required capability to avoid the redirect to the maintenance page.
	 *
	 * @since 0.1.0
	 */
	$required_capability = apply_filters( 'vip_maintenance_mode_required_cap', 'edit_posts' );
	return current_user_can( $required_capability );
}

add_action( 'template_redirect', 'vip_maintenance_mode_template_redirect' );
/**
 * Redirects visitors and users without edit_posts capability to the maintenance page
 *
 * Uses the plugin template when there's no template called `template-maintenance-mode.php` in the theme root folder.
 *
 * @since 0.1.1
 */
function vip_maintenance_mode_template_redirect() {
	if ( vip_maintenance_mode_current_user_can_bypass() ) {
		return;
	}

	/**
	 * Filters whether to respond with a 503 status code.
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

	header( 'X-Maintenance-Mode-WP: true' );
	
	if ( locate_template( 'template-maintenance-mode.php' ) ) {
		get_template_part( 'template-maintenance-mode' );
	} else {
		include __DIR__ . '/template-maintenance-mode.php';
	}
	exit;
}

add_action( 'rest_authentication_errors', 'vip_maintenance_mode_restrict_rest_api' );
/**
 * Restricts access to the REST API during maintenance mode.
 *
 * This function checks if the REST API should be restricted during maintenance mode and returns an error if the user is not logged in or does not have the capability to bypass maintenance mode.
 *
 * @param WP_Error|mixed $result The result of the authentication check.
 * @return WP_Error|mixed The error object if the REST API is restricted, otherwise the original result.
 */
function vip_maintenance_mode_restrict_rest_api( $result ) {
	if ( ! empty( $result ) ) {
		return $result;
	}

	$should_restrict_api = apply_filters( 'vip_maintenance_mode_restrict_rest_api', true );
	if ( ! $should_restrict_api ) {
		return $result;
	}

	$error_message         = apply_filters( 'vip_maintenance_mode_rest_api_error_message', __( 'REST API access is currently restricted while this site is undergoing maintenance.', 'maintenance-mode' ) );
	$maintenace_rest_error = new WP_Error(
		'vip_maintenance_mode_rest_error',
		$error_message,
		array(
			'status' => 503,
		)
	);

	if ( ! is_user_logged_in() ) {
		return $maintenace_rest_error;
	}

	if ( ! vip_maintenance_mode_current_user_can_bypass() ) {
		return $maintenace_rest_error;
	}

	return $result;
}

add_action( 'admin_bar_menu', 'vip_maintenance_mode_admin_bar_menu', 8 );
/**
 * Displays a notice in the admin bar to indicate that maintenance mode is enabled
 *
 * Only displayed to users who don't see the maintenance page.
 *
 * @since 0.1.1
 */
function vip_maintenance_mode_admin_bar_menu() {
	global $wp_admin_bar;

	if ( ! vip_maintenance_mode_current_user_can_bypass() ) {
		return;
	}

	$wp_admin_bar->add_menu(
		array(
			'id'     => 'maintenance-mode',
			'parent' => 'top-secondary',
			'title'  => apply_filters( 'vip_maintenance_mode_admin_bar_title', __( 'Under maintenance', 'maintenance-mode' ) ),
			'meta'   => array( 'class' => 'mm-notice' ),
		)
	);
}

add_action( 'wp_enqueue_scripts', 'vip_maintenance_mode_admin_scripts' );
add_action( 'admin_enqueue_scripts', 'vip_maintenance_mode_admin_scripts' );
/**
 * Styles the admin bar notice
 *
 * @since 0.1.1
 */
function vip_maintenance_mode_admin_scripts() {
	$styles = '#wpadminbar .mm-notice .ab-item {
		background: #ffcc00 !important;
		background: linear-gradient( #ffcc00, #e6b400 ) !important;
		color: #23282d !important;
		font-weight:500;
	}';
	wp_add_inline_style( 'admin-bar', $styles );
}

add_action( 'init', 'vip_maintenance_mode_load_plugin_textdomain' );
/**
 * Localize plugin
 *
 * @since 0.1.1
 * @uses load_plugin_textdomain
 * @return void
 */
function vip_maintenance_mode_load_plugin_textdomain() {
	load_plugin_textdomain( 'maintenance-mode', false, basename( __DIR__ ) . '/languages/' );
}
