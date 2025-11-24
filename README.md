<div align="center">

<img src="https://raw.githubusercontent.com/alizharb/flare/main/art/logo.svg" width="120" alt="Flare Logo">

# Flare

### Production-Ready Toast Notifications for Laravel Livewire

**Elegant • Performant • Customizable**

[![PHP Version](https://img.shields.io/badge/PHP-8.3%2B-777BB4?style=flat-square&logo=php&logoColor=white)](https://php.net)
[![Laravel](https://img.shields.io/badge/Laravel-12.0%2B-FF2D20?style=flat-square&logo=laravel&logoColor=white)](https://laravel.com)
[![Livewire](https://img.shields.io/badge/Livewire-3.5%2B-4E56A6?style=flat-square&logo=livewire&logoColor=white)](https://livewire.laravel.com)
[![Tests](https://img.shields.io/github/actions/workflow/status/alizharb/flare/tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/alizharb/flare/actions)
[![License](https://img.shields.io/badge/License-MIT-green.svg?style=flat-square)](LICENSE)
[![Downloads](https://img.shields.io/packagist/dt/alizharb/flare?style=flat-square)](https://packagist.org/packages/alizharb/flare)

[Features](#-features) • [Installation](#-installation) • [Quick Start](#-quick-start) • [Documentation](#-documentation) • [Themes](#-themes) • [Examples](#-examples)

</div>

---

## 🎯 Overview

Flare is a modern, feature-rich toast notification system built specifically for Laravel Livewire applications. With **zero configuration** required and **three distinct visual themes**, Flare provides beautiful user feedback out of the box while offering extensive customization for advanced use cases.

```php
// Simple, elegant API
Flare::success('Profile updated successfully!');

// Full control when you need it
Flare::warning(
    text: 'Session expires in 5 minutes',
    heading: 'Warning',
    duration: 10000,
    position: 'top center'
);
```

---

## ✨ Features

<table>
<tr>
<td width="50%" valign="top">

### 🎨 **Three Professional Themes**

- **Classic** - Minimal, clean, fastest performance
- **Modern** - Balanced design with subtle effects _(default)_
- **Vibrant** - Bold, colorful, attention-grabbing

All themes include:

- ✓ Light & dark mode support
- ✓ Smooth animations
- ✓ Responsive design
- ✓ RTL/LTR layouts

### ⚡ **High Performance**

- Alpine.js powered (minimal overhead)
- Optimized CSS transitions
- Smart caching & compilation
- No jQuery dependency
- Lightweight footprint (~15KB)

### 🔧 **Developer Experience**

- **Zero Configuration** - Works out of the box
- **Simple API** - Intuitive, clean methods
- **Livewire Trait** - `use WithFlare`
- **TypeScript Support** - Full type definitions
- **IDE Autocomplete** - PHPDoc annotations

</td>
<td width="50%" valign="top">

### 📍 **Flexible Positioning**

- 6 position options (top/bottom × start/center/end)
- Per-toast position override
- RTL/LTR automatic adaptation
- Responsive mobile behavior

### 🎭 **Advanced Features**

- **Stacking System** - Configurable toast layering
- **Auto-Dismiss** - Configurable duration
- **Hover Pause** - Pause on mouse hover
- **Keyboard Shortcuts** - Esc, Shift+Esc, Alt+D
- **Progress Bar** - Visual countdown
- **Queue Management** - Handle multiple toasts

### 🧪 **Production Ready**

- ✓ Comprehensive test suite (12 tests, 22 assertions)
- ✓ PHPStan Level 9 compliance
- ✓ PSR-12 code style
- ✓ CI/CD with GitHub Actions
- ✓ Semantic versioning
- ✓ Extensive documentation

</td>
</tr>
</table>

---

## 📋 Requirements

| Requirement   | Version                        |
| ------------- | ------------------------------ |
| **PHP**       | 8.3+                           |
| **Laravel**   | 12.0+                          |
| **Livewire**  | 3.5+                           |
| **Alpine.js** | 3.x _(included in Livewire 3)_ |

---

## 🚀 Installation

### Step 1: Install via Composer

```bash
composer require alizharb/flare
```

### Step 2: Publish Assets

> **IMPORTANT**: Assets must be published for Flare to work.

```bash
php artisan vendor:publish --tag=flare-assets
```

### Step 3: Add to Layout

```blade
<!DOCTYPE html>
<html lang="en">
<head>
    @flareStyles {{-- Required --}}
</head>
<body>
    <flare::toasts /> {{-- Required --}}

    @flareScripts {{-- Required --}}
</body>
</html>
```

**That's it!** 🎉 You're ready to use Flare.

<details>
<summary><strong>Optional Configuration</strong></summary>

```bash
# Publish config file
php artisan vendor:publish --tag=flare-config

# Publish views for customization
php artisan vendor:publish --tag=flare-views
```

</details>

---

## ⚡ Quick Start

### Using the Facade

Perfect for controllers, services, and any PHP class:

```php
use AlizHarb\Flare\Facades\Flare;

class UserController extends Controller
{
    public function store(Request $request)
    {
        User::create($request->validated());

        Flare::success('User created successfully!');

        return redirect()->route('users.index');
    }
}
```

### Using the Livewire Trait

The easiest way in Livewire components:

```php
use Livewire\Component;
use AlizHarb\Flare\Concerns\WithFlare;

class CreatePost extends Component
{
    use WithFlare;

    public function save()
    {
        Post::create($this->validate());

        $this->flareSuccess('Post published!', 'Success');
    }
}
```

### Using JavaScript

For client-side notifications:

```javascript
// Simple
Flare.success("Item added to cart!");

// Advanced
Flare.toast("Welcome back!", {
  heading: "Hello User",
  variant: "info",
  duration: 5000,
  position: "top center",
});
```

---

## 🎨 Themes

Flare includes three professionally designed themes. Choose the one that fits your application's aesthetic.

<table>
<tr>
<td width="33%" align="center">

### Classic

**Minimal & Professional**

Solid backgrounds  
Single shadow  
No blur  
⚡ Fastest

```php
'theme' => 'classic'
```

</td>
<td width="33%" align="center">

### Modern

**Balanced & Contemporary**

Subtle gradients  
Light blur (4px)  
2 shadow layers  
⚡ Fast _(default)_

```php
'theme' => 'modern'
```

</td>
<td width="33%" align="center">

### Vibrant

**Bold & Colorful**

Strong gradients  
Glowing shadows  
Moderate blur (8px)  
⚡ Good

```php
'theme' => 'vibrant'
```

</td>
</tr>
</table>

**All themes support light & dark modes automatically.**

---

## 📚 Documentation

### 📖 Complete Documentation

Visit our comprehensive documentation:

- **[Introduction](docs/introduction.md)** - What is Flare?
- **[Installation](docs/installation.md)** - Detailed setup guide
- **[Quick Start](docs/quick-start.md)** - Get started in 5 minutes
- **[Themes](docs/themes.md)** - Visual customization
- **[Configuration](docs/configuration.md)** - All options explained
- **[Examples](EXAMPLES.md)** - Real-world scenarios

### 🌐 Interactive Docs

Run the documentation website locally:

```bash
php -S localhost:8000 -t docs
```

Visit `http://localhost:8000` for interactive documentation.

---

## 💡 API Reference

### Toast Variants

```php
Flare::success($text, $heading = null, $duration = 5000, $position = null);
Flare::warning($text, $heading = null, $duration = 5000, $position = null);
Flare::danger($text, $heading = null, $duration = 5000, $position = null);
Flare::error($text, $heading = null, $duration = 5000, $position = null); // Alias
Flare::info($text, $heading = null, $duration = 5000, $position = null);
```

### Livewire Trait Methods

```php
$this->flareSuccess($text, $heading = null, $duration = 5000, $position = null);
$this->flareWarning($text, $heading = null, $duration = 5000, $position = null);
$this->flareDanger($text, $heading = null, $duration = 5000, $position = null);
$this->flareError($text, $heading = null, $duration = 5000, $position = null);
$this->flareInfo($text, $heading = null, $duration = 5000, $position = null);
```

### JavaScript API

```javascript
Flare.toast(text, options);
Flare.success(text, options);
Flare.warning(text, options);
Flare.danger(text, options);
Flare.error(text, options);
Flare.info(text, options);
```

---

## ⚙️ Configuration

<details>
<summary><strong>View Complete Configuration</strong></summary>

```php
return [
    // Visual theme
    'theme' => 'modern', // classic, modern, vibrant

    // Default position
    'position' => 'bottom end',

    // Default duration (ms)
    'duration' => 5000,

    // Stacking behavior
    'enable_stacking' => true,
    'stack_expanded' => false,
    'max_visible' => 3,

    // Features
    'icons' => ['enabled' => true],
    'actions' => ['enabled' => true],
    'priority' => ['enabled' => true],
    'rate_limit' => ['enabled' => true],
    'progress_bar' => ['enabled' => true],
];
```

</details>

### Environment Variables

```env
FLARE_THEME=modern
FLARE_POSITION="bottom end"
FLARE_DURATION=5000
FLARE_ENABLE_STACKING=true
FLARE_STACK_EXPANDED=false
```

---

## 🎯 Examples

### Form Validation

```php
class ContactForm extends Component
{
    use WithFlare;

    public function submit()
    {
        $this->validate([...]);

        // Send email...

        $this->flareSuccess(
            text: "Thank you! We'll get back to you soon.",
            heading: 'Message Sent',
            duration: 7000
        );
    }
}
```

### CRUD Operations

```php
public function destroy(Post $post)
{
    $post->delete();

    Flare::danger(
        text: 'Post has been permanently deleted',
        heading: 'Deleted',
        duration: 4000
    );

    return redirect()->route('posts.index');
}
```

### Persistent Notifications

```php
// Requires manual dismissal
Flare::danger(
    text: 'Critical error - please contact support',
    heading: 'Error',
    duration: 0 // Never auto-dismiss
);
```

**See [EXAMPLES.md](EXAMPLES.md) for more real-world scenarios.**

---

## ⌨️ Keyboard Shortcuts

| Shortcut      | Action                             |
| ------------- | ---------------------------------- |
| `Esc`         | Dismiss most recent toast          |
| `Shift + Esc` | Dismiss all toasts                 |
| `Alt + D`     | Dismiss all toasts _(alternative)_ |

---

## 🧪 Testing

Flare includes a comprehensive test suite:

```bash
# Run tests
composer test

# Run tests with coverage
composer test:coverage

# Run static analysis
composer analyse

# Run code style fixer
composer format
```

**Test Results:** ✅ 12 tests, 22 assertions, 100% passing

---

## 🤝 Contributing

We welcome contributions! Please see [CONTRIBUTING.md](CONTRIBUTING.md) for details.

### Development Setup

```bash
git clone https://github.com/alizharb/flare.git
cd flare
composer install
composer test
```

---

## 📝 Changelog

See [CHANGELOG.md](CHANGELOG.md) for all changes and version history.

### Latest Release: v1.1.0

- ✨ Three distinct themes (Classic, Modern, Vibrant)
- 🐛 Fixed all positioning issues
- ⚡ Improved stacking performance
- 🌍 Added RTL/LTR support
- 📚 Complete documentation

---

## 📄 License

Flare is open-source software licensed under the [MIT License](LICENSE).

---

## 🙏 Credits

**Built with ❤️ by [Ali Harb](https://github.com/alizharb)**

Special thanks to:

- Laravel & Livewire teams
- Alpine.js community
- All contributors

---

## 🌟 Support

If you find Flare useful, please consider:

- ⭐ Starring the repository
- 🐛 Reporting bugs
- 💡 Suggesting features
- 📖 Improving documentation
- 💰 [Sponsoring development](https://github.com/sponsors/alizharb)

---

<div align="center">

**[⬆ Back to Top](#flare)**

Made with ❤️ for the Laravel community

</div>
