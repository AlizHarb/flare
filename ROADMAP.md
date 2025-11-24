# Flare Roadmap

## Current Version: 1.0.0

This roadmap outlines the current state, planned improvements, and future direction for the Flare toast notification package.

---

## ✅ Current Features (v1.0.0)

### Core Functionality

- ✅ Toast notification system with 4 variants (success, warning, danger, info)
- ✅ Flexible positioning (6 positions: top/bottom × start/center/end)
- ✅ Configurable auto-dismiss with duration control
- ✅ Toast queue management with max visible limit
- ✅ Hover-to-pause functionality
- ✅ Keyboard navigation (Esc, Shift+Esc, Alt+D)

### Integration

- ✅ Laravel Livewire 3.5+ integration
- ✅ `WithFlare` trait for Livewire components
- ✅ Facade for global access (`Flare::success()`)
- ✅ JavaScript API for client-side notifications
- ✅ Auto-discovery support

### Developer Experience

- ✅ Comprehensive PHPDoc documentation
- ✅ Full Pest test suite (12 tests, 22 assertions)
- ✅ PHPStan Level 9 static analysis (0 errors)
- ✅ PSR-12 code style compliance
- ✅ GitHub Actions CI/CD workflow
- ✅ Extensive README with examples

### Customization

- ✅ Publishable configuration file
- ✅ Publishable views for customization
- ✅ Publishable assets (JS/CSS)
- ✅ Environment variable support
- ✅ Dark mode support

---

## 🔧 Technical Debt & Improvements

### High Priority

- [ ] **Test Coverage**: Expand test coverage to include edge cases
  - Component rendering tests
  - Configuration validation tests
  - JavaScript integration tests
- [ ] **Documentation**: Add inline code examples to all public methods
- [ ] **Performance**: Benchmark and optimize JavaScript bundle size
- [ ] **Accessibility**: Add ARIA labels and screen reader support

### Medium Priority

- [ ] **TypeScript Definitions**: Create `.d.ts` files for JavaScript API
- [ ] **Storybook**: Add Storybook for component showcase
- [ ] **Browser Testing**: Add Playwright/Dusk tests for UI interactions
- [ ] **Code Coverage**: Achieve 100% code coverage with Pest

### Low Priority

- [ ] **Localization**: Add i18n support for toast messages
- [ ] **Themes**: Create pre-built theme variants
- [ ] **Animation Library**: Expand animation options

---

## 🚀 Planned Features

### ✅ v1.1.0 - Enhanced Customization (COMPLETED - 2025-11-23)

- [x] **Custom Icons**: Support for custom icons per variant
- [x] **Progress Bar**: Visual progress indicator for auto-dismiss
- [x] **Action Buttons**: Add action buttons to toasts (e.g., "Undo", "View")
- [x] **Toast Templates**: Pre-built templates for common use cases
- [x] **Sound Notifications**: Optional sound effects for toasts
- [x] **Animations**: Additional animation styles (slide, fade, bounce)

### ✅ v1.2.0 - Advanced Features (COMPLETED - 2025-11-23)

- [x] **Toast Groups**: Group related toasts together
- [x] **Priority System**: Priority-based toast ordering
- [x] **Persistent Storage**: Remember dismissed toasts across sessions
- [x] **Rate Limiting**: Prevent toast spam
- [x] **Toast History**: View history of dismissed toasts
- [x] **Batch Operations**: Dismiss multiple toasts by category
- [x] **TypeScript Definitions**: Full TypeScript support

### v1.3.0 - Integration & Ecosystem (Q3 2026)

- [ ] **Inertia.js Support**: Native Inertia.js integration
- [ ] **Filament Plugin**: Official Filament admin panel plugin
- [ ] **Jetstream Integration**: Pre-configured for Laravel Jetstream
- [ ] **Broadcasting**: Laravel Echo integration for real-time toasts
- [ ] **API Responses**: Automatic toast from API responses
- [ ] **Validation Errors**: Auto-convert validation errors to toasts

### v2.0.0 - Major Overhaul (Q4 2026)

- [ ] **Headless Mode**: Unstyled components for full customization
- [ ] **React/Vue Support**: Framework-agnostic JavaScript library
- [ ] **Mobile App Support**: React Native / Flutter integration
- [ ] **Advanced Positioning**: Custom positioning with coordinates
- [ ] **Toast Containers**: Multiple independent toast containers
- [ ] **Plugin System**: Extensible plugin architecture

---

## 🎯 Long-Term Vision

### Developer Experience

- **Zero Config**: Work out-of-the-box with sensible defaults
- **Full Customization**: Every aspect customizable without forking
- **Best-in-Class DX**: Industry-leading developer experience
- **Comprehensive Docs**: Interactive documentation with live examples

### Performance

- **Minimal Bundle**: < 5KB gzipped JavaScript
- **Lazy Loading**: Load only when needed
- **Tree Shaking**: Full tree-shaking support
- **Zero Dependencies**: Remove all external dependencies

### Ecosystem

- **Official Plugins**: Curated plugin ecosystem
- **Community Themes**: Community-contributed themes
- **Starter Kits**: Pre-configured starter templates
- **Video Tutorials**: Comprehensive video course

---

## 📊 Metrics & Goals

### Code Quality

- ✅ PHPStan Level 9: **Achieved**
- ✅ PSR-12 Compliance: **Achieved**
- 🎯 100% Test Coverage: **Target Q1 2026**
- 🎯 A+ Security Score: **Target Q2 2026**

### Performance

- 🎯 < 5KB JS Bundle: **Target Q2 2026**
- 🎯 < 2KB CSS Bundle: **Target Q2 2026**
- 🎯 Lighthouse 100: **Target Q3 2026**

### Adoption

- 🎯 1,000 GitHub Stars: **Target Q2 2026**
- 🎯 10,000 Downloads: **Target Q3 2026**
- 🎯 50+ Contributors: **Target Q4 2026**

---

## 🤝 Contributing

We welcome contributions! Areas where we need help:

### Immediate Needs

- **Testing**: Write additional unit and integration tests
- **Documentation**: Improve examples and tutorials
- **Bug Fixes**: Fix reported issues
- **Performance**: Optimize JavaScript and CSS

### Future Contributions

- **Feature Development**: Implement roadmap features
- **Plugin Development**: Create community plugins
- **Theme Development**: Design custom themes
- **Localization**: Translate documentation

---

## 📝 Changelog

See [CHANGELOG.md](CHANGELOG.md) for detailed version history.

---

## 📞 Feedback

Have ideas for Flare? We'd love to hear from you!

- **GitHub Issues**: [Report bugs or request features](https://github.com/alizharb/flare/issues)
- **Discussions**: [Join the conversation](https://github.com/alizharb/flare/discussions)
- **Email**: [alizharb@example.com](mailto:alizharb@example.com)

---

**Last Updated**: 2025-11-23  
**Maintained by**: [Aliz Harb](https://github.com/alizharb)
