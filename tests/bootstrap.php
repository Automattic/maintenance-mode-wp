<?php
/**
 * PHPUnit tests bootstrap
 * 
 * @package Automattic\MaintenanceMode
 */

$vip_maintenance_mode_tests_dir = getenv( 'WP_TESTS_DIR' );
if ( '' === $vip_maintenance_mode_tests_dir || false === $vip_maintenance_mode_tests_dir ) {
	$vip_maintenance_mode_tests_dir = '/tmp/wordpress-tests-lib';
}

// phpcs:ignore WordPressVIPMinimum.Files.IncludingFile.UsingVariable
require_once $vip_maintenance_mode_tests_dir . '/includes/functions.php';

/**
 * Manually load the plugin being tested.
 */
function vip_maintenance_mode_manually_load_plugin(): void {
	require __DIR__ . '/../maintenance-mode.php';
}

tests_add_filter( 'muplugins_loaded', 'vip_maintenance_mode_manually_load_plugin' );

// phpcs:ignore WordPressVIPMinimum.Files.IncludingFile.UsingVariable
require $vip_maintenance_mode_tests_dir . '/includes/bootstrap.php';

require __DIR__ . '/maintenance-mode-testcase.php';
