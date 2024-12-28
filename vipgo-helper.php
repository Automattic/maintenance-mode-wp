<?php
/**
 * WordPress VIP platform-specific code
 * 
 * This file is not included by the plugin, but is included if the plugin is run on the WordPress VIP platform.
 * 
 * @package Automattic/MaintenanceMode
 */

add_filter( 'vip_maintenance_mode_respond_503', 'vip_maintenance_mode_do_not_respond_503_for_services', 30 );
/**
 * Prevent the Maintenance Mode plugin returning a 503 HTTP status to specific bots and services.
 *
 * Maintenance Mode sets a 503 header on page requests if Maintenance Mode is enabled and this leads to site monitoring tools like Nagios
 * reporting lots of server errors and Jetpack not being able to verify connection status for sites that are just in maintenance mode.
 * 
 * This function sets the filter response that Maintenance Mode uses to determine if it should set the 503 status header or not.
 *
 * @param bool $should_set_503 Whether Maintenance Mode should set a 503 header.
 * @return bool Indicate whether a Maintenance Mode sets a 503 header.
 */
function vip_maintenance_mode_do_not_respond_503_for_services( $should_set_503 ): bool {
	$user_agent = filter_input( INPUT_SERVER, 'HTTP_USER_AGENT', FILTER_SANITIZE_SPECIAL_CHARS );

	if (
		// Nagios desktop checks use something like `check_http/v2.2.1 (nagios-plugins 2.2.1)`.
		false !== strpos( $user_agent, 'check_http' ) ||

		// Nagios mobile checks use `iphone`.
		'iphone' === $user_agent ||

		// UptimeRobot uses something like `UptimeRobot/2.0; http://www.uptimerobot.com/`.
		false !== stripos( $user_agent, 'UptimeRobot' ) ||

		// Utilize helper function vip_is_jetpack_request if available.
		( function_exists( 'vip_is_jetpack_request' ) && vip_is_jetpack_request() )
	) {
		return false;
	}

	return $should_set_503;
}
