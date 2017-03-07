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

// Stops the execution early if the VIP_MAINTENANCE_MODE constant is not set to `true`.
if ( !defined( 'VIP_MAINTENANCE_MODE' ) || true !== VIP_MAINTENANCE_MODE ) {
	add_action( 'admin_notices', 'vip_maintenance_mode_admin_notice__constant_not_set' );
	return;
}

/**
 * Redirects visitors and users without edit_posts capability to the maintenance page
 *
 * Uses the plugin template when there's no template called `template-maintenance-mode.php` in the theme root folder.
 *
 * @since 0.1.1
 */
function vip_maintenance_mode_template_redirect() {
	$required_capability = apply_filters( 'vip_maintenance_mode_required_cap', 'edit_posts' );
	if ( current_user_can( $required_capability ) ) {
		return;
	}

	if ( locate_template( 'template-maintenance-mode.php' ) ) {
		get_template_part( 'template-maintenance-mode' );
	} else {
		include( __DIR__ . '/template-maintenance-mode.php' );
	}
	exit;
}
add_action( 'template_redirect', 'vip_maintenance_mode_template_redirect' );

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

/**
 * Displays a warning in the admin to inform users about the VIP_MAINTENANCE_MODE constant
 *
 * Only users who can activate plugins will see the warning.
 *
 * @since 0.1.1
 */
function vip_maintenance_mode_admin_notice__constant_not_set() {
	if ( !current_user_can( 'activate_plugins' ) ) {
		return;
	}

	$class = 'notice notice-warning';
	$message = __( 'Maintenance Mode won\'t work until you set the VIP_MAINTENANCE_MODE constant to <code>true</code>.', 'maintenance-mode' );
	printf( '<div class="%1$s"><p>%2$s</p></div>', $class, wp_kses( $message, array( 'code' => array() ), array() ) );
}