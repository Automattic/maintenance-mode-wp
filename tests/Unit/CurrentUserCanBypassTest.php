<?php
/**
 * Unit tests for the current user can bypass functionality.
 *
 * @package Automattic\MaintenanceMode\Tests\Unit
 */

declare( strict_types=1 );

namespace Automattic\MaintenanceMode\Tests\Unit;

use Brain\Monkey\Functions;

/**
 * Test case for current user can bypass.
 */
class CurrentUserCanBypassTest extends TestCase {

	/**
	 * Set up test fixtures.
	 */
	protected function setUp(): void {
		parent::setUp();

		// Define the constant for testing.
		if ( ! defined( 'VIP_MAINTENANCE_MODE' ) ) {
			define( 'VIP_MAINTENANCE_MODE', true );
		}

		// Load the plugin file.
		require_once dirname( __DIR__, 2 ) . '/maintenance-mode.php';
	}

	/**
	 * Test that users with default capability can bypass.
	 */
	public function test_user_with_edit_posts_can_bypass(): void {
		Functions\expect( 'apply_filters' )
			->once()
			->with( 'vip_maintenance_mode_required_cap', 'edit_posts' )
			->andReturn( 'edit_posts' );

		Functions\expect( 'current_user_can' )
			->once()
			->with( 'edit_posts' )
			->andReturn( true );

		$result = vip_maintenance_mode_current_user_can_bypass();

		$this->assertTrue( $result );
	}

	/**
	 * Test that users without default capability cannot bypass.
	 */
	public function test_user_without_edit_posts_cannot_bypass(): void {
		Functions\expect( 'apply_filters' )
			->once()
			->with( 'vip_maintenance_mode_required_cap', 'edit_posts' )
			->andReturn( 'edit_posts' );

		Functions\expect( 'current_user_can' )
			->once()
			->with( 'edit_posts' )
			->andReturn( false );

		$result = vip_maintenance_mode_current_user_can_bypass();

		$this->assertFalse( $result );
	}

	/**
	 * Test that custom capability filter is respected.
	 */
	public function test_custom_capability_filter_is_respected(): void {
		Functions\expect( 'apply_filters' )
			->once()
			->with( 'vip_maintenance_mode_required_cap', 'edit_posts' )
			->andReturn( 'manage_options' );

		Functions\expect( 'current_user_can' )
			->once()
			->with( 'manage_options' )
			->andReturn( true );

		$result = vip_maintenance_mode_current_user_can_bypass();

		$this->assertTrue( $result );
	}
}
