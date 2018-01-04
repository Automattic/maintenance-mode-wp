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
function wpcom_vip_maintenance_mode_do_not_respond_503_for_nagios() {

	// Check if request is coming from Nagios.
	if ( ! empty( $_SERVER['HTTP_USER_AGENT'] ) && false === strpos( $_SERVER['HTTP_USER_AGENT'], 'check_http' ) ) {

		// Not a Nagios request so allow the 503 header to be set.
		return true;
	} else {

		// The request comes from Nagios so deny the 503 header being set.
		return false;
	}
}

add_filter( 'vip_maintenance_mode_respond_503', 'wpcom_vip_maintenance_mode_do_not_respond_503_for_nagios', 30, 0 );
