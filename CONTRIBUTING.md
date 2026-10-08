# Contributing to Maintenance Mode

Thanks for your interest in contributing. This document covers where to report things, how to set up a local environment, and what we expect from a pull request.

## Where things go

| Type of report | Where |
|---|---|
| Bug report or feature request | [GitHub issue](https://github.com/Automattic/maintenance-mode-wp/issues) |
| Security vulnerability | [HackerOne](https://hackerone.com/automattic), not a public issue |

This plugin is intentionally small. Before proposing a feature that expands its scope, please open an issue to discuss it first.

## Local development

Integration tests use [`@wordpress/env`](https://www.npmjs.com/package/@wordpress/env), which requires Docker.

```bash
git clone git@github.com:Automattic/maintenance-mode-wp.git
cd maintenance-mode-wp
composer install
npx wp-env start
```

## Pull requests

- Branch from `develop`, using a descriptive name such as `fix/rest-api-bypass` or `feature/custom-template-path`. Releases are merged into `main` and tagged from there.
- Keep each change focused. If you spot an unrelated issue, open a separate PR.
- Include tests for behaviour changes: unit tests in `tests/Unit/` for isolated logic, integration tests in `tests/Integration/` for anything that depends on WordPress.
- Write commit messages that explain why the change was made, not just what changed.
- **Sign your commits.** The `develop` and `main` branches only accept commits with a verified signature, so a PR containing an unsigned commit can't be merged until its commits are re-signed and force-pushed. See [GitHub's guide to signing commits](https://docs.github.com/en/authentication/managing-commit-signature-verification/signing-commits).

Before pushing, make sure these pass locally:

```bash
composer cs                # Code standards (PHPCS)
composer lint              # PHP syntax lint
composer test:unit         # Unit tests
composer test:integration  # Integration tests (requires wp-env)
```

`composer cs-fix` fixes what PHPCS can fix automatically.

## Coding standards

Code follows the [WordPress coding standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/) as enforced by `automattic/vipwpcs`, configured in `.phpcs.xml.dist`. All user-facing strings use the `maintenance-mode` text domain.
