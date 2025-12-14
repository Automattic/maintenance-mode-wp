<?php
/**
 * Unit tests for the REST API restriction functionality.
 *
 * @package Automattic\MaintenanceMode\Tests\Unit
 */

declare( strict_types=1 );

namespace Automattic\MaintenanceMode\Tests\Unit;

use Brain\Monkey\Functions;
use WP_Error;

/**
 * Test case for REST API restriction.
 */
class RestrictRestApiTest extends TestCase {

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
	 * Test that existing errors are passed through unchanged.
	 */
	public function test_existing_error_passed_through(): void {
		$existing_error = new WP_Error( 'existing_error', 'Existing error message' );

		$result = vip_maintenance_mode_restrict_rest_api( $existing_error );

		$this->assertSame( $existing_error, $result );
	}

	/**
	 * Test that API is not restricted when filter returns false.
	 */
	public function test_api_not_restricted_when_filter_returns_false(): void {
		Functions\expect( 'apply_filters' )
			->once()
			->with( 'vip_maintenance_mode_restrict_rest_api', true )
			->andReturn( false );

		$result = vip_maintenance_mode_restrict_rest_api( null );

		$this->assertNull( $result );
	}

	/**
	 * Test that unauthenticated users get an error.
	 */
	public function test_unauthenticated_users_get_error(): void {
		Functions\expect( 'apply_filters' )
			->once()
			->with( 'vip_maintenance_mode_restrict_rest_api', true )
			->andReturn( true );

		Functions\expect( 'apply_filters' )
			->once()
			->with( 'vip_maintenance_mode_rest_api_error_message', \Mockery::type( 'string' ) )
			->andReturnUsing( function ( $filter, $message ) {
				return $message;
			} );

		Functions\expect( 'is_user_logged_in' )
			->once()
			->andReturn( false );

		Functions\expect( '__' )
			->andReturnUsing( function ( $text ) {
				return $text;
			} );

		$result = vip_maintenance_mode_restrict_rest_api( null );

		$this->assertInstanceOf( WP_Error::class, $result );
		$this->assertSame( 'vip_maintenance_mode_rest_error', $result->get_error_code() );
	}

	/**
	 * Test that authenticated users without capability get an error.
	 */
	public function test_authenticated_users_without_capability_get_error(): void {
		Functions\expect( 'apply_filters' )
			->once()
			->with( 'vip_maintenance_mode_restrict_rest_api', true )
			->andReturn( true );

		Functions\expect( 'apply_filters' )
			->once()
			->with( 'vip_maintenance_mode_rest_api_error_message', \Mockery::type( 'string' ) )
			->andReturnUsing( function ( $filter, $message ) {
				return $message;
			} );

		Functions\expect( 'apply_filters' )
			->once()
			->with( 'vip_maintenance_mode_required_cap', 'edit_posts' )
			->andReturn( 'edit_posts' );

		Functions\expect( 'is_user_logged_in' )
			->once()
			->andReturn( true );

		Functions\expect( 'current_user_can' )
			->once()
			->with( 'edit_posts' )
			->andReturn( false );

		Functions\expect( '__' )
			->andReturnUsing( function ( $text ) {
				return $text;
			} );

		$result = vip_maintenance_mode_restrict_rest_api( null );

		$this->assertInstanceOf( WP_Error::class, $result );
		$this->assertSame( 'vip_maintenance_mode_rest_error', $result->get_error_code() );
	}

	/**
	 * Test that authenticated users with capability can access API.
	 */
	public function test_authenticated_users_with_capability_can_access(): void {
		Functions\expect( 'apply_filters' )
			->once()
			->with( 'vip_maintenance_mode_restrict_rest_api', true )
			->andReturn( true );

		Functions\expect( 'apply_filters' )
			->once()
			->with( 'vip_maintenance_mode_rest_api_error_message', \Mockery::type( 'string' ) )
			->andReturnUsing( function ( $filter, $message ) {
				return $message;
			} );

		Functions\expect( 'apply_filters' )
			->once()
			->with( 'vip_maintenance_mode_required_cap', 'edit_posts' )
			->andReturn( 'edit_posts' );

		Functions\expect( 'is_user_logged_in' )
			->once()
			->andReturn( true );

		Functions\expect( 'current_user_can' )
			->once()
			->with( 'edit_posts' )
			->andReturn( true );

		Functions\expect( '__' )
			->andReturnUsing( function ( $text ) {
				return $text;
			} );

		$result = vip_maintenance_mode_restrict_rest_api( null );

		$this->assertNull( $result );
	}
}
