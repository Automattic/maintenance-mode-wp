<?php

/**
 * Prevent the maintenance_mode plugin returning a 503 HTTP status to Nagios.
 *
 * Maintenance_mode sets a 503 header on page requests if maintenance_mode is enabled and this leads to  Nagios
 * reporting lots of server errors for sites that are just in maintenance_mode. This function sets the filter
 * response that maintenance_mode uses to determine if it shoudl set teh 503 status header or not.
 *
 * @return bool Should maintenance_mode set a 503 header
 */
function wpcom_vip_maintenance_mode_do_not_respond_503_for_nagios( $should_set_503 ) {
	$user_agent = ! empty( $_SERVER['HTTP_USER_AGENT'] ) ? $_SERVER['HTTP_USER_AGENT'] : '';

	// The request comes from Nagios so deny the 503 header being set.
	// Desktop checks use something like `check_http/v2.2.1 (nagios-plugins 2.2.1)`.
	// Mobile checks use `iphone`.
	if ( false !== strpos( $user_agent, 'check_http' ) || 'iphone' === $user_agent ) {
		return false;
	}

	return $should_set_503;
}

add_filter( 'vip_maintenance_mode_respond_503', 'wpcom_vip_maintenance_mode_do_not_respond_503_for_nagios', 30 );
