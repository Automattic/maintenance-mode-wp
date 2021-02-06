# Maintenance Mode

[![Build Status](https://api.travis-ci.com/Automattic/maintenance-mode.svg?branch=master)](https://api.travis-ci.com/Automattic/maintenance-mode)
[![GPLv2 License](https://img.shields.io/github/license/Automattic/maintenance-mode.svg)](https://www.gnu.org/licenses/gpl.html)
[![Tag Version](https://img.shields.io/github/tag/Automattic/maintenance-mode.svg)](https://wordpress.org/plugins/maintenance-mode/)

Shut down your site for a little while and do some maintenance on it!

## Installation

1. Upload `maintenance-mode` to the `/wp-content/plugins/` directory
2. Activate the plugin through the _Plugins_ menu in WordPress

## Usage

- Add a template to your theme's root folder called `template-maintenance-mode.php`.
- This should be a simple HTML page that should include the message you want to show your visitors.
- Note: the template should include `wp_head()` and `wp_footer()` calls.
- Add the `VIP_MAINTENANCE_MODE` constant to your theme and set to `true` or activate the maintenance mode via customizer

## Changelog

### 0.3.0

* Allow activation of maintenance mode via customizer ([#37](https://github.com/Automattic/maintenance-mode-wp/issues/37))

### 0.2.2

* Stop returning a 503 to Jetpack requests to prevent broken connection verification

### 0.2.1

* Stop returning a 503 to Nagios on WPCom and VipGo to prevent alerting as a server error

### 0.2.0

* Return a 503 header while maintenance mode is active (props benoitchantre)
* Add an admin bar notice when Maintenance Mode is on (props benoitchantre)

### 0.1.0

* Initial plugin
