# Flare Roadmap

## Current Version: 1.0.0

This roadmap outlines the current state, planned improvements, and future direction for the Flare toast notification package.

---

## ✅ Current Features (v1.0.0)

### Core Functionality

-   ✅ Toast notification system with 4 variants (success, warning, danger, info)
-   ✅ Flexible positioning (6 positions: top/bottom × start/center/end)
-   ✅ Configurable auto-dismiss with duration control
-   ✅ Toast queue management with max visible limit
-   ✅ Hover-to-pause functionality
-   ✅ Keyboard navigation (Esc, Shift+Esc, Alt+D)
-   ✅ **Sound Notifications**: Optional sound effects for toasts
-   ✅ **Progress Bar**: Visual progress indicator logic
-   ✅ **Priority System**: Priority-based toast ordering
-   ✅ **Toast Groups**: Group related toasts together
-   ✅ **Rate Limiting**: Prevent toast spam

### Integration

-   ✅ Laravel Livewire 3.5+ integration
-   ✅ `WithFlare` trait for Livewire components
-   ✅ Facade for global access (`Flare::success()`)
-   ✅ JavaScript API for client-side notifications
-   ✅ Auto-discovery support

### Customization

-   ✅ Publishable configuration file
-   ✅ Publishable views for customization
-   ✅ Publishable assets (JS/CSS)
-   ✅ Environment variable support
-   ✅ Dark mode support
-   ✅ **Custom Icons**: Support for custom icons per variant
-   ✅ **Action Buttons**: Support for action buttons (Undo, View, etc.)
-   ✅ **Toast Templates**: Pre-built templates for common use cases

### Developer Experience

-   ✅ Comprehensive PHPDoc documentation
-   ✅ Full Pest test suite (12 tests, 22 assertions)
-   ✅ PHPStan Level 9 static analysis (0 errors)
-   ✅ PSR-12 code style compliance
-   ✅ GitHub Actions CI/CD workflow
-   ✅ Extensive README with examples
-   ✅ **Toast History**: Track dismissed toasts (in-memory)

---

## 🚀 Future Roadmap

### v1.1.0 - UI Refinement & Persistence (Q1 2026)

-   [ ] **Visual Polish**: Implement visual rendering for Progress Bars and Action Buttons in default Blade component
-   [ ] **Persistent History**: Save toast history to `localStorage` for cross-session persistence
-   [ ] **Enhanced Icons**: Better rendering support for custom SVG icons in default view
-   [ ] **Accessibility**: Add ARIA labels and improved screen reader support

### v1.2.0 - Ecosystem Integrations (Q2 2026)

-   [ ] **Inertia.js Support**: Native adapter for Inertia.js applications
-   [ ] **Filament Plugin**: Official Filament admin panel integration
-   [ ] **Jetstream Support**: Pre-configured styles for Laravel Jetstream
-   [ ] **Broadcasting**: Laravel Echo integration for real-time server-sent toasts

### v1.3.0 - Advanced Developer Tools (Q3 2026)

-   [ ] **Toast Builder**: Interactive UI to generate toast code
-   [ ] **Debug Mode**: Enhanced debugging information in development
-   [ ] **TypeScript Definitions**: Official `.d.ts` files for better IDE support
-   [ ] **Storybook**: Component showcase and interactive documentation

### v2.0.0 - The Headless Evolution (Q4 2026)

-   [ ] **Headless Mode**: Completely unstyled components for maximum customization
-   [ ] **Framework Agnostic**: Core logic separated for use with React/Vue/Svelte
-   [ ] **Mobile Support**: React Native / Flutter integration bridges
-   [ ] **Plugin Architecture**: Extensible system for community plugins

---

## 🎯 Long-Term Vision

### Developer Experience

-   **Zero Config**: Work out-of-the-box with sensible defaults
-   **Full Customization**: Every aspect customizable without forking
-   **Best-in-Class DX**: Industry-leading developer experience

### Performance

-   **Minimal Bundle**: < 5KB gzipped JavaScript
-   **Zero Dependencies**: Remove all external dependencies
-   **Tree Shaking**: Full tree-shaking support

### Ecosystem

-   **Official Plugins**: Curated plugin ecosystem
-   **Community Themes**: Community-contributed themes
-   **Starter Kits**: Pre-configured starter templates

---

## 📊 Metrics & Goals

### Code Quality

-   ✅ PHPStan Level 9: **Achieved**
-   ✅ PSR-12 Compliance: **Achieved**
-   🎯 100% Test Coverage: **Target Q1 2026**

### Performance

-   🎯 < 5KB JS Bundle: **Target Q2 2026**
-   🎯 Lighthouse 100: **Target Q3 2026**

### Adoption

-   🎯 1,000 GitHub Stars: **Target Q2 2026**
-   🎯 10,000 Downloads: **Target Q3 2026**

---

## 🤝 Contributing

We welcome contributions! Please see our [Contributing Guide](CONTRIBUTING.md) for details.

---

## 📞 Feedback

-   **GitHub Issues**: [Report bugs or request features](https://github.com/alizharb/flare/issues)
-   **Discussions**: [Join the conversation](https://github.com/alizharb/flare/discussions)

---

**Last Updated**: 2025-11-27
**Maintained by**: [Aliz Harb](https://github.com/alizharb)
