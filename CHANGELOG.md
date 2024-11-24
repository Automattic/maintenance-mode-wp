# Changelog for Maintenance Mode

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [0.2.2] - 2019-08-08

### Added
- Added Composer support by @spacedmonkey in https://github.com/Automattic/maintenance-mode-wp/pull/24
- Add custom `X-Maintenance-Mode-WP` header by @mjangda in https://github.com/Automattic/maintenance-mode-wp/pull/32

### Fixed
- Fix misnamed callback by @mattoperry in https://github.com/Automattic/maintenance-mode-wp/pull/27

### Changed
- Prevent 503s for nagios mobile checks by @mjangda in https://github.com/Automattic/maintenance-mode-wp/pull/29
- Change REST error message to be more descriptive by @rebeccahum in https://github.com/Automattic/maintenance-mode-wp/pull/31
- Don't send 503 on requests coming from Jetpack by @rinatkhaziev in https://github.com/Automattic/maintenance-mode-wp/pull/38

### Maintenance
- Travis: Add PHP 7.2 by @mjangda in https://github.com/Automattic/maintenance-mode-wp/pull/33
- Bump the "works up to" to 5.0 by @whyisjake in https://github.com/Automattic/maintenance-mode-wp/pull/35

## [0.2.1] - 2018-01-04

### Added
- Allow restricting access to REST API requests by @mjangda in https://github.com/Automattic/maintenance-mode-wp/pull/17

### Changed
- Stop sending a 503 response to Nagios so activating maintenance mode … by @anigeluk in https://github.com/Automattic/maintenance-mode-wp/pull/21

### Maintenance
- Bumping version numbers by @anigeluk in https://github.com/Automattic/maintenance-mode-wp/pull/22

## [0.2.0] - 2017-03-20

### Added
- i18n by @benoitchantre in https://github.com/Automattic/maintenance-mode-wp/pull/8
- Return a 503 header by @benoitchantre in https://github.com/Automattic/maintenance-mode-wp/pull/1
- Stops the execution early and warns the user by @benoitchantre in https://github.com/Automattic/maintenance-mode-wp/pull/10
- Show that maintenance mode is enabled by @benoitchantre in https://github.com/Automattic/maintenance-mode-wp/pull/12

### Fixed
- Declares a doctype by @benoitchantre in https://github.com/Automattic/maintenance-mode-wp/pull/6
- Typo by @benoitchantre in https://github.com/Automattic/maintenance-mode-wp/pull/4

### Maintenance
- Tests: Add basic syntax check by @philipjohn in https://github.com/Automattic/maintenance-mode-wp/pull/7
- Proofreading by @benoitchantre in https://github.com/Automattic/maintenance-mode-wp/pull/11

## 0.1.0 - 2017-02-16
- Initial release.


[0.2.2]: https://github.com/automattic/maintenance-mode-wp/compare/0.2.1...0.2.2
[0.2.1]: https://github.com/automattic/maintenance-mode-wp/compare/0.2.0...0.2.1
[0.2.0]: https://github.com/automattic/maintenance-mode-wp/compare/0.1.0...0.2.0