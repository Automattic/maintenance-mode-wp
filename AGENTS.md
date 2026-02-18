# Maintenance Mode

Simple maintenance mode plugin for WordPress VIP.

## Project Knowledge

| Property | Value |
|----------|-------|
| **Main file** | `maintenance-mode.php` |
| **Text domain** | `maintenance-mode` |
| **Namespace** | Global |
| **Source directory** | Root level (simple plugin) |
| **Version** | 0.3.2 |
| **Requires PHP** | 7.4+ |
| **Requires WP** | 6.4+ |

### Directory Structure

```
maintenance-mode-wp/
├── maintenance-mode.php            # Main plugin file
├── template-maintenance-mode.php   # Front-end maintenance template
├── rector.php                      # Rector configuration for code modernisation
├── tests/
│   ├── Unit/                       # Unit tests (CurrentUserCanBypass, RestrictRestApi)
│   └── Integration/                # Integration tests (wp-env)
├── .github/workflows/              # CI: cs-lint, integration, unit
└── .phpcs.xml.dist                 # PHPCS configuration
```

### Key Files

- `maintenance-mode.php` — Plugin logic: hooks, capability checks, REST API restrictions
- `template-maintenance-mode.php` — The HTML template shown to visitors during maintenance

### Dependencies

- **Dev**: `automattic/vipwpcs`, `yoast/wp-test-utils`, `rector/rector`

## Commands

```bash
composer cs                # Check code standards (PHPCS)
composer cs-fix            # Auto-fix code standard violations
composer lint              # PHP syntax lint
composer test:unit         # Run unit tests
composer test:integration  # Run integration tests (requires wp-env)
composer test:integration-ms  # Run multisite integration tests
composer coverage          # Run tests with HTML coverage report
composer rector            # Run Rector for code modernisation suggestions
```

## Conventions

Follow the standards documented in `~/code/plugin-standards/` for full details. Key points:

- **Commits**: Use the `/commit` skill. Favour explaining "why" over "what".
- **PRs**: Use the `/pr` skill. Squash and merge by default.
- **Branch naming**: `feature/description`, `fix/description` from `develop`.
- **Testing**: Write integration tests for WordPress-dependent behaviour, unit tests for isolated logic. Use `Yoast\WPTestUtils\WPIntegration\TestCase` for integration, `Yoast\WPTestUtils\BrainMonkey\YoastTestCase` for unit.
- **Code style**: WordPress coding standards via PHPCS. Tabs for indentation.
- **i18n**: All user-facing strings must use the `maintenance-mode` text domain.

## Architectural Decisions

- **Intentionally simple**: This is a small, single-purpose plugin. It uses global functions rather than classes. Do not over-engineer or add unnecessary abstractions.
- **VIP-specific**: Designed for WordPress VIP environments. Uses VIP-compatible patterns for capability checks and REST API restrictions.
- **Template separation**: The maintenance page template is in a separate file (`template-maintenance-mode.php`) so themes can override it. Do not inline the template into the main plugin file.
- **Rector available**: The plugin includes Rector for automated code modernisation. Use `composer rector` to check for opportunities.

## Common Pitfalls

- Do not edit WordPress core files or bundled dependencies in `vendor/`.
- Run `composer cs` before committing. CI will reject code standard violations.
- Integration tests require `npx wp-env start` running first.
- The maintenance template must remain a separate file — themes may override it by placing a copy in their template directory.
- Do not add complex features to this plugin. It is intentionally minimal. Feature requests that expand scope significantly should be questioned.
- Be careful with capability checks — incorrect changes could either lock out admins or fail to show the maintenance page to visitors.
- REST API restrictions must not block authenticated admin requests, or it will break the WordPress admin.
