# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.1.0] - 2025-11-24

### Added

#### Theme System

- **3 Distinct Themes**: Classic (minimal), Modern (balanced), Vibrant (bold)
- **Theme Configuration**: New `theme` config option to choose visual style
- **Light/Dark Mode**: All themes support both light and dark modes
- **Theme-Specific Effects**: Conditional backdrop-filter, gradients, and shadows per theme

#### Configuration Enhancements

- **Enable Stacking**: New `enable_stacking` config to toggle stacking behavior
- **Better Config Integration**: All config options now properly respected

### Fixed

#### Critical Positioning Fixes

- **All 6 Positions Working**: Fixed positioning system using standard CSS properties
- **Browser Compatibility**: Replaced `inset-inline` with `left`/`right` for better support
- **RTL Support**: Proper bidirectional layout support with `[dir="rtl"]` selectors
- **Z-Index**: Reduced from 999999 to 50 (Tailwind standard) to prevent conflicts

#### Performance Improvements

- **Stacking Lag**: Reduced transition duration from 0.2s to 0.15s for smoother animations
- **Hover Performance**: Optimized transitions with `will-change` property
- **Gap in Expanded Mode**: Added proper spacing (0.75rem) between toasts when expanded

#### Visual Improvements

- **Modern Design**: Glassmorphism effects for Modern and Vibrant themes
- **Gradient Backgrounds**: Subtle gradients per variant in Modern/Vibrant themes
- **Colored Shadows**: Variant-specific shadow colors for better visual hierarchy
- **Reduced Blur**: Optimized blur levels (Classic: none, Modern: 4px, Vibrant: 8px)

### Changed

- **Default Theme**: Set to `modern` for balanced aesthetics
- **Positioning System**: Complete rewrite using standard CSS properties
- **Stacking Transitions**: Faster, smoother animations with cubic-bezier easing
- **Container Overflow**: Fixed to prevent page layout breaks

## [1.1.1] - 2025-11-23

### Fixed

### Changed

- **Component Architecture**: Simplified to use `<flare::toasts />` as the main component
- **UI Improvements**: Moved progress bar to bottom of toast card; improved responsive positioning
- **Stacking**: Stacking is now purely config-driven (via `expanded` prop/config)

### Removed

- **ToastGroup**: Removed `<flare::toast.group />` in favor of the simpler `<flare::toasts />` alias

### Important

- Users MUST run `php artisan vendor:publish --tag=flare-assets` after installation
- Blade component syntax is now `<flare::toast />` and `<flare::toast-group>` (not `toast.group`)

## [1.0.0] - 2025-10-05

### Added

- Initial release
- Beautiful toast notification system
- Support for multiple variants (success, warning, danger, info)
- Flexible positioning options (6 positions)
- WithFlare trait for easy Livewire integration
- Facade for global access
- Comprehensive PHPDoc documentation
- Full Pest test coverage
- GitHub Actions CI/CD workflow
- PHPStan level 9 static analysis
- Laravel Pint code formatting
- Keyboard navigation support (Esc, Shift+Esc, Alt+D)
- Alpine.js powered animations
- Real-time Livewire integration
- Auto-dismiss with configurable duration
- Hover-to-pause functionality
- Dark mode support
- Responsive design
- Accessibility features (ARIA labels, screen reader support)

[1.1.0]: https://github.com/alizharb/flare/compare/v1.0.0...v1.1.0
[1.0.0]: https://github.com/alizharb/flare/releases/tag/v1.0.0
