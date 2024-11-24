<?php
/**
 * Basic testcase
 * 
 * @package Automattic\Maintenance Mode
 */

/**
 * Base unit test class for Maintenance Mode
 */
class MaintenanceMode_TestCase extends WP_UnitTestCase {
	/**
	 * Set up tests.
	 */
	public function set_up() {
		parent::setUp();

		global $maintenance_mode;
		$this->_toc = $maintenance_mode;
	}
}
