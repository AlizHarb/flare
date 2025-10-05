# Contributing to Flare

Thank you for considering contributing to Flare! We welcome contributions from the community.

## Development Setup

1. Fork the repository
2. Clone your fork: `git clone https://github.com/yourusername/flare.git`
3. Install dependencies: `composer install`
4. Create a feature branch: `git checkout -b feature/your-feature-name`

## Coding Standards

We follow the Laravel coding standards and use the following tools:

### Running Tests

```bash
composer test
```

### Running Tests with Coverage

```bash
composer test-coverage
```

### Static Analysis

```bash
composer analyse
```

### Code Formatting

```bash
composer format
```

## Code Quality Requirements

Before submitting a pull request, ensure:

1. ✅ All tests pass
2. ✅ PHPStan analysis passes (level 9)
3. ✅ Code is formatted with Pint
4. ✅ New features include tests
5. ✅ Documentation is updated
6. ✅ PHPDoc blocks are complete (without author/version)

## Pull Request Process

1. Update the README.md with details of changes if needed
2. Update the CHANGELOG.md following [Keep a Changelog](https://keepachangelog.com/) format
3. Ensure all tests and checks pass
4. Request review from maintainers
5. Once approved, the PR will be merged

## Commit Messages

Please follow conventional commit format:

- `feat:` - New feature
- `fix:` - Bug fix
- `docs:` - Documentation changes
- `style:` - Code style changes (formatting, etc)
- `refactor:` - Code refactoring
- `test:` - Adding or updating tests
- `chore:` - Maintenance tasks

Example: `feat: add support for custom toast icons`

## Bug Reports

When filing a bug report, please include:

1. PHP version
2. Laravel version
3. Livewire version
4. Steps to reproduce
5. Expected behavior
6. Actual behavior
7. Any error messages

## Feature Requests

We love new ideas! Please include:

1. Clear description of the feature
2. Use cases and benefits
3. Any implementation suggestions
4. Examples if applicable

## Code of Conduct

Be respectful, inclusive, and constructive in all interactions.

## Questions?

Feel free to open an issue for questions or discussions.

Thank you for contributing! 🚀
