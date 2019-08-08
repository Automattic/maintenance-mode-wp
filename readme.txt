=== Maintenance Mode ===
Contributors: wpcomvip, automattic, benoitchantre, emrikol, philipjohn
Tags: maintenance-mode maintenance
Requires at least: 4.6
Tested up to: 5.2.2
Stable tag: 0.2.2
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Shut down your site for a little while and do some maintenance on it!

== Description ==

Usage:
 - Add a template to your theme's root folder called `template-maintenance-mode.php`.
 - This should be a simple HTML page that should include the message you want to show your visitors.
 - Note: the template should include `wp_head()` and `wp_footer()` calls.
 - Add the VIP_MAINTENANCE_MODE constant to your theme and set to `true`.

== Installation ==

1. Install the plugin.
1. Set the `VIP_MAINTENANCE_MODE` constant to true.
1. Activate.

== Changelog ==

= 0.2.2 =
* Stop returning a 503 to Jetpack requests to prevent broken connection verification

= 0.2.1 =
* Stop returning a 503 to Nagios on WPCom and VipGo to prevent alerting as a server error

= 0.2.0 =
* Return a 503 header while maintenance mode is active (props benoitchantre)
* Add an admin bar notice when Maintenance Mode is on (props benoitchantre)

= 0.1.0 =
* Initial plugin
