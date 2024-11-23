<?php
/**
 * Basic testcase
 */

/**
 * Base unit test class for Maintenance Mode
 */
class MaintenanceMode_TestCase extends WP_UnitTestCase {
	public function set_up() {
		parent::setUp();

		global $maintenance_mode;
		$this->_toc = $maintenance_mode;
	}
}
