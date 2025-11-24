# Introduction

Welcome to **Flare** - a beautiful, modern toast notification system designed specifically for Laravel Livewire applications.

## What is Flare?

Flare is a production-ready toast notification package that brings elegant, customizable notifications to your Laravel Livewire applications. With zero configuration required and extensive customization options, Flare makes it easy to provide beautiful user feedback.

## Key Features

### 🎨 Three Distinct Themes

- **Classic** - Minimal, clean, professional (best performance)
- **Modern** - Balanced design with subtle effects (default)
- **Vibrant** - Bold, colorful, eye-catching

### 📍 Flexible Positioning

- 6 position options (top/bottom × start/center/end)
- RTL/LTR support
- Responsive on all devices

### ⚡ High Performance

- Alpine.js powered
- Optimized animations
- Smart caching
- Minimal overhead

### 🔧 Developer Friendly

- Simple, intuitive API
- Livewire trait integration
- JavaScript API
- Full TypeScript support

## Quick Example

```php
use AlizHarb\Flare\Facades\Flare;

// Simple success notification
Flare::success('Profile updated successfully!');

// With heading and custom duration
Flare::warning(
    text: 'Session will expire soon',
    heading: 'Warning',
    duration: 10000
);
```

## Why Choose Flare?

1. **Zero Configuration** - Works out of the box
2. **Beautiful Design** - Three professionally designed themes
3. **Production Ready** - Fully tested and optimized
4. **Highly Customizable** - Configure every aspect
5. **Great DX** - Simple API, comprehensive docs

## Next Steps

- [Installation](installation.md) - Get started in minutes
- [Quick Start](quick-start.md) - Your first toast
- [Configuration](configuration.md) - Customize Flare
- [Examples](examples.md) - Real-world use cases
