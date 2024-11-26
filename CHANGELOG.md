# Changelog for Maintenance Mode

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [0.3.0] - 2024-11-25

Predominantly a maintenance release, though it does include a couple of added changes, and a couple of breaking changes

### Breaking Changes
- `current_user_can_bypass_vip_maintenance_mode()` has been renamed to `vip_maintenance_mode_current_user_can_bypass()`. This was only called inside other functions, but if you had custom code that called it, this will need updating.
- The minimum support version of PHP has been increased from 5.6 to 7.4.
- The minimum support version of WordPress has been increased from 4.6 to 5.9.

### Added
- Add UptimeRobot to ignore list by @BrookeDot in https://github.com/Automattic/maintenance-mode-wp/pull/50
- Template: improve template loading by @GaryJones in https://github.com/Automattic/maintenance-mode-wp/pull/60

### Maintenance
- Remove PHP 5.6 from Travis test matrix by @rinatkhaziev in https://github.com/Automattic/maintenance-mode-wp/pull/39
- Setup github actions by @trepmal in https://github.com/Automattic/maintenance-mode-wp/pull/41
- PHPCS fixes by @trepmal in https://github.com/Automattic/maintenance-mode-wp/pull/42
- Add readme with screenshots by @trepmal in https://github.com/Automattic/maintenance-mode-wp/pull/43
- Update github actions by @trepmal in https://github.com/Automattic/maintenance-mode-wp/pull/44
- Migrating plugin instructions from old VIP Docs site to plugin's README.md by @yolih in https://github.com/Automattic/maintenance-mode-wp/pull/49
- Composer: Add allow-plugins config by @GaryJones in https://github.com/Automattic/maintenance-mode-wp/pull/53
- CI: Refresh CI configs and Composer dependencies by @GaryJones in https://github.com/Automattic/maintenance-mode-wp/pull/54
- CS: Fix coding standards violations issues by @GaryJones in https://github.com/Automattic/maintenance-mode-wp/pull/55
- Docs: Add new default theme screenshots by @GaryJones in https://github.com/Automattic/maintenance-mode-wp/pull/56
- Docs: Add changelog file by @GaryJones in https://github.com/Automattic/maintenance-mode-wp/pull/57
- Add Rector by @GaryJones in https://github.com/Automattic/maintenance-mode-wp/pull/58
- CS: Address low severity violations by @GaryJones in https://github.com/Automattic/maintenance-mode-wp/pull/59
- Docs: Consolidate two readme files by @GaryJones in https://github.com/Automattic/maintenance-mode-wp/pull/61
- Add version bump script by @GaryJones in https://github.com/Automattic/maintenance-mode-wp/pull/62
- Dev: Add/update development files by @GaryJones in https://github.com/Automattic/maintenance-mode-wp/pull/63

### Removed
- Remove wpcom helper by @trepmal in https://github.com/Automattic/maintenance-mode-wp/pull/46

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


[0.3.0]: https://github.com/automattic/maintenance-mode-wp/compare/0.2.2...0.3.0
[0.2.2]: https://github.com/automattic/maintenance-mode-wp/compare/0.2.1...0.2.2
[0.2.1]: https://github.com/automattic/maintenance-mode-wp/compare/0.2.0...0.2.1
[0.2.0]: https://github.com/automattic/maintenance-mode-wp/compare/0.1.0...0.2.0
