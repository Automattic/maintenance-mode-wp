# Maintenance Mode

[![Build Status](https://api.travis-ci.com/Automattic/maintenance-mode.svg?branch=master)](https://api.travis-ci.com/Automattic/maintenance-mode)
[![GPLv2 License](https://img.shields.io/github/license/Automattic/maintenance-mode.svg)](https://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
[![Tag Version](https://img.shields.io/github/tag/Automattic/maintenance-mode.svg)](https://wordpress.org/plugins/maintenance-mode/)

Contributors: wpcomvip, automattic, benoitchantre, emrikol, philipjohn, nielslange
Tags: maintenance-mode maintenance
Requires at least: 4.6
Tested up to: 5.6
Stable tag: 0.2.2
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Shut down your site for a little while and do some maintenance on it!

## Installation

1. Install `maintenance-mode` in the `/wp-content/plugins/` directory
1. Activate the plugin through the _Plugins_ menu in WordPress
1. Set the `VIP_MAINTENANCE_MODE` constant to true or activate teh maintenance mode via Customizer.

## Usage

- Add a template to your theme's root folder called `template-maintenance-mode.php`.
- This should be a simple HTML page that should include the message you want to show your visitors.
- Note: the template should include `wp_head()` and `wp_footer()` calls.
- Add the `VIP_MAINTENANCE_MODE` constant to your theme and set to `true` or activate the maintenance mode via customizer

## Changelog

### 0.2.2

* Stop returning a 503 to Jetpack requests to prevent broken connection verification

### 0.2.1

* Stop returning a 503 to Nagios on WPCom and VipGo to prevent alerting as a server error

### 0.2.0

* Return a 503 header while maintenance mode is active (props benoitchantre)
* Add an admin bar notice when Maintenance Mode is on (props benoitchantre)

### 0.1.0

* Initial plugin
