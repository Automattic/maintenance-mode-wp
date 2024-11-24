<?php
/**
 * PHPUnit tests bootstrap
 * 
 * @package Automattic\MaintenanceMode
 */

$_tests_dir = getenv( 'WP_TESTS_DIR' );
if ( ! $_tests_dir ) {
	$_tests_dir = '/tmp/wordpress-tests-lib';
}

require_once $_tests_dir . '/includes/functions.php';

/**
 * Manually load the plugin being tested.
 */
function _manually_load_plugin(): void {
	require __DIR__ . '/../maintenance-mode.php';
}

tests_add_filter( 'muplugins_loaded', '_manually_load_plugin' );

require $_tests_dir . '/includes/bootstrap.php';

require __DIR__ . '/maintenance-mode-testcase.php';
