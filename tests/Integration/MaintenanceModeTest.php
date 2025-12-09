<?php
/**
 * Integration tests for the Maintenance Mode plugin.
 *
 * @package Automattic\MaintenanceMode\Tests\Integration
 */

declare( strict_types=1 );

namespace Automattic\MaintenanceMode\Tests\Integration;

use Yoast\WPTestUtils\WPIntegration\TestCase;

/**
 * Maintenance Mode integration test case.
 */
final class MaintenanceModeTest extends TestCase {

	/**
	 * Test that the VIP_MAINTENANCE_MODE constant is defined.
	 */
	public function test_vip_maintenance_mode_constant_is_defined(): void {
		$this->assertTrue( defined( 'VIP_MAINTENANCE_MODE' ) );
		$this->assertTrue( VIP_MAINTENANCE_MODE );
	}

	/**
	 * Test that users with edit_posts capability can bypass maintenance mode.
	 */
	public function test_user_with_edit_posts_can_bypass(): void {
		$user_id = self::factory()->user->create( [ 'role' => 'editor' ] );
		wp_set_current_user( $user_id );

		$this->assertTrue( vip_maintenance_mode_current_user_can_bypass() );
	}

	/**
	 * Test that users without edit_posts capability cannot bypass maintenance mode.
	 */
	public function test_user_without_edit_posts_cannot_bypass(): void {
		$user_id = self::factory()->user->create( [ 'role' => 'subscriber' ] );
		wp_set_current_user( $user_id );

		$this->assertFalse( vip_maintenance_mode_current_user_can_bypass() );
	}

	/**
	 * Test that logged out users cannot bypass maintenance mode.
	 */
	public function test_logged_out_user_cannot_bypass(): void {
		wp_set_current_user( 0 );

		$this->assertFalse( vip_maintenance_mode_current_user_can_bypass() );
	}

	/**
	 * Test that the required capability filter works.
	 */
	public function test_required_capability_filter(): void {
		$user_id = self::factory()->user->create( [ 'role' => 'administrator' ] );
		wp_set_current_user( $user_id );

		// By default, editors can bypass (edit_posts).
		$this->assertTrue( vip_maintenance_mode_current_user_can_bypass() );

		// Change required capability to manage_options.
		add_filter(
			'vip_maintenance_mode_required_cap',
			function () {
				return 'manage_options';
			}
		);

		// Admin can still bypass with manage_options.
		$this->assertTrue( vip_maintenance_mode_current_user_can_bypass() );

		// Editor cannot bypass with manage_options.
		$editor_id = self::factory()->user->create( [ 'role' => 'editor' ] );
		wp_set_current_user( $editor_id );

		$this->assertFalse( vip_maintenance_mode_current_user_can_bypass() );
	}

	/**
	 * Test that the admin bar menu is added for users who can bypass.
	 */
	public function test_admin_bar_menu_added_for_authorized_users(): void {
		$this->assertTrue( has_action( 'admin_bar_menu', 'vip_maintenance_mode_admin_bar_menu' ) !== false );
	}

	/**
	 * Test that the template_redirect action is hooked.
	 */
	public function test_template_redirect_is_hooked(): void {
		$this->assertTrue( has_action( 'template_redirect', 'vip_maintenance_mode_template_redirect' ) !== false );
	}

	/**
	 * Test that the REST API authentication filter is hooked.
	 */
	public function test_rest_authentication_filter_is_hooked(): void {
		$this->assertTrue( has_filter( 'rest_authentication_errors', 'vip_maintenance_mode_restrict_rest_api' ) !== false );
	}

	/**
	 * Test that REST API returns error for logged out users.
	 */
	public function test_rest_api_returns_error_for_logged_out_users(): void {
		wp_set_current_user( 0 );

		$result = vip_maintenance_mode_restrict_rest_api( null );

		$this->assertInstanceOf( 'WP_Error', $result );
		$this->assertSame( 'vip_maintenance_mode_rest_error', $result->get_error_code() );
	}

	/**
	 * Test that REST API allows access for users who can bypass.
	 */
	public function test_rest_api_allows_access_for_authorized_users(): void {
		$user_id = self::factory()->user->create( [ 'role' => 'editor' ] );
		wp_set_current_user( $user_id );

		$result = vip_maintenance_mode_restrict_rest_api( null );

		$this->assertNull( $result );
	}

	/**
	 * Test that REST API restriction can be disabled via filter.
	 */
	public function test_rest_api_restriction_can_be_disabled(): void {
		wp_set_current_user( 0 );

		add_filter( 'vip_maintenance_mode_restrict_rest_api', '__return_false' );

		$result = vip_maintenance_mode_restrict_rest_api( null );

		$this->assertNull( $result );

		remove_filter( 'vip_maintenance_mode_restrict_rest_api', '__return_false' );
	}
}
