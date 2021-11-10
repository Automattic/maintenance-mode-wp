[![Run PHPUnit and PHPCS](https://github.com/Automattic/maintenance-mode-wp/actions/workflows/integrate.yml/badge.svg)](https://github.com/Automattic/maintenance-mode-wp/actions/workflows/integrate.yml)

# Maintenance Mode

Shut down your site for a little while and do some maintenance on it!

Usage:

 - Add a template to your theme's root folder called `template-maintenance-mode.php`.
 - This should be a simple HTML page that should include the message you want to show your visitors.
 - Note: the template should include `wp_head()` and `wp_footer()` calls.

## Installation

1. Install the plugin.
1. Activate.

## Default template screenshots

On Twenty Twenty-One:
![Screenshot of active Maintenance mode on Twenty Twenty-One](screenshot-twentytwentyone.png)

On Twenty Twenty:
![Screenshot of active Maintenance mode on Twenty Twenty](screenshot-twentytwenty.png)

On Twenty Nineteen:
![Screenshot of active Maintenance mode on Twenty Nineteen](screenshot-twentynineteen.png)

On Twenty Seventeen:
![Screenshot of active Maintenance mode on Twenty Seventeen](screenshot-twentyseventeen.png)

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
