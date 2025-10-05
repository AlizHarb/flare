<div align="center">

# 🔥 Flare

### Beautiful Toast Notifications for Laravel Livewire

A modern, performant, and highly customizable toast notification system designed specifically for Laravel Livewire applications with real-time support and stunning animations.

[![Tests](https://github.com/alizharb/flare/workflows/Tests/badge.svg)](https://github.com/alizharb/flare/actions)
[![PHP Version](https://img.shields.io/badge/PHP-8.4%2B-777BB4?logo=php&logoColor=white)](https://php.net)
[![Laravel](https://img.shields.io/badge/Laravel-12.0%2B-FF2D20?logo=laravel&logoColor=white)](https://laravel.com)
[![Livewire](https://img.shields.io/badge/Livewire-3.5%2B-4E56A6?logo=livewire&logoColor=white)](https://livewire.laravel.com)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

[Features](#-features) • [Installation](#-installation) • [Usage](#-usage) • [Documentation](#-documentation) • [Contributing](#-contributing)

---

![Flare Demo](https://via.placeholder.com/800x400/667eea/ffffff?text=Flare+Toast+Notifications+Demo)

*Beautiful, performant toast notifications that enhance user experience*

</div>

---

## ✨ Features

<table>
<tr>
<td width="50%">

### 🎨 **Beautiful Design**
- Stunning, modern UI with smooth animations
- Multiple variants (success, warning, danger, info)
- Fully customizable styling
- Dark mode ready
- Responsive on all devices

### ⚡ **High Performance**
- Alpine.js powered for minimal overhead
- Optimized animations with CSS transitions
- Lazy loading support
- No jQuery dependency
- Lightweight footprint

### 🔧 **Developer Friendly**
- Simple, intuitive API
- Trait for easy Livewire integration
- Facade for global access
- TypeScript definitions ready
- Full IDE autocomplete support

</td>
<td width="50%">

### 🚀 **Advanced Features**
- Real-time updates with Livewire
- Queue management for multiple toasts
- Auto-dismiss with configurable duration
- Hover to pause auto-dismiss
- Keyboard navigation support
- Position flexibility (9 positions)

### 🧪 **Production Ready**
- Comprehensive Pest test suite
- PHPStan Level 9 analysis
- 100% code coverage
- CI/CD with GitHub Actions
- Semantic versioning

### 📦 **Easy Integration**
- Zero configuration required
- Auto-discovery support
- Publishable assets & views
- Minimal setup time
- Extensive documentation

</td>
</tr>
</table>

---

## 📋 Requirements

- **PHP**: 8.4 or higher
- **Laravel**: 12.0 or higher
- **Livewire**: 3.5 or higher
- **Alpine.js**: 3.x (included in Livewire 3)

---

## 🚀 Installation

Install Flare via Composer:

```bash
composer require alizharb/flare
```

### Publish Assets (Optional)

Publish the configuration file:

```bash
php artisan vendor:publish --tag=flare-config
```

Publish the views (for customization):

```bash
php artisan vendor:publish --tag=flare-views
```

Publish the assets (JavaScript & CSS):

```bash
php artisan vendor:publish --tag=flare-assets
```

---

## ⚙️ Setup

### 1. Add Scripts & Styles

Include Flare's scripts and styles in your layout:

```blade
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My App</title>

    <!-- Flare Styles -->
    @flareStyles
</head>
<body>
    {{ $slot }}

    <!-- Flare Scripts -->
    @flareScripts
</body>
</html>
```

### 2. Add Toast Component

Add the toast component to your layout (place once, typically in your main layout):

```blade
<!-- Using Livewire Component -->
<livewire:flare-toasts />

<!-- OR using Blade Component -->
<x-flare::toast />

<!-- OR with custom position and settings -->
<livewire:flare-toasts position="top center" :expanded="true" />
```

**That's it!** You're ready to use Flare 🎉

---

## 💡 Usage

Flare provides multiple ways to trigger toast notifications based on your preferences and use cases.

### 🎯 Method 1: Using the Facade (Anywhere in Your App)

Perfect for controllers, services, jobs, and any other class:

```php
use AlizHarb\Flare\Facades\Flare;

class UserController extends Controller
{
    public function store(Request $request)
    {
        // Your logic here...

        // Show success toast
        Flare::success('User created successfully!');

        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();

        // Show danger toast with heading
        Flare::danger('User has been deleted', 'Warning');

        return back();
    }
}
```

### 🔥 Method 2: Using the WithFlare Trait (Livewire Components)

The easiest way to use Flare in Livewire components:

```php
use Livewire\Component;
use AlizHarb\Flare\Concerns\WithFlare;

class CreatePost extends Component
{
    use WithFlare;

    public $title;
    public $content;

    public function save()
    {
        $this->validate([
            'title' => 'required|min:3',
            'content' => 'required',
        ]);

        Post::create([
            'title' => $this->title,
            'content' => $this->content,
        ]);

        // Show success toast
        $this->flareSuccess('Post published successfully!', 'Success');

        $this->reset();
    }

    public function delete()
    {
        // Show warning toast
        $this->flareWarning('This action cannot be undone', 'Warning');
    }

    public function someAction()
    {
        // Custom toast with all options
        $this->flareToast(
            text: 'Operation completed',
            heading: 'Success',
            duration: 3000,
            variant: 'info',
            position: 'top center'
        );
    }

    public function render()
    {
        return view('livewire.create-post');
    }
}
```

### 🌐 Method 3: Using JavaScript API (Frontend)

For dynamic client-side notifications:

```javascript
// Simple success toast
Flare.success('Item added to cart!');

// Warning toast
Flare.warning('Stock is running low');

// Error toast
Flare.error('Failed to process payment');

// Custom toast with options
Flare.toast('Welcome back!', {
    heading: 'Hello User',
    variant: 'info',
    duration: 5000,
    position: 'top center'
});

// Persistent toast (duration: 0)
Flare.toast('Please review your settings', {
    variant: 'warning',
    duration: 0  // Won't auto-dismiss
});
```

---

## 📚 API Reference

### Facade Methods

All Facade methods are available through `AlizHarb\Flare\Facades\Flare`:

```php
// Basic toast (default variant)
Flare::toast(string $text, ?string $heading = null, int $duration = 5000, ?string $variant = null, ?string $position = null): void

// Success toast (green)
Flare::success(string $text, ?string $heading = null, int $duration = 5000, ?string $position = null): void

// Warning toast (yellow)
Flare::warning(string $text, ?string $heading = null, int $duration = 5000, ?string $position = null): void

// Danger toast (red)
Flare::danger(string $text, ?string $heading = null, int $duration = 5000, ?string $position = null): void

// Error toast (alias for danger)
Flare::error(string $text, ?string $heading = null, int $duration = 5000, ?string $position = null): void

// Info toast (blue)
Flare::info(string $text, ?string $heading = null, int $duration = 5000, ?string $position = null): void

// Generate script tag
Flare::scripts(): string

// Generate style tag
Flare::styles(): string
```

### WithFlare Trait Methods

All trait methods are available in Livewire components:

```php
// Basic toast
$this->flareToast(string $text, ?string $heading = null, int $duration = 5000, ?string $variant = null, ?string $position = null): void

// Success toast
$this->flareSuccess(string $text, ?string $heading = null, int $duration = 5000, ?string $position = null): void

// Warning toast
$this->flareWarning(string $text, ?string $heading = null, int $duration = 5000, ?string $position = null): void

// Danger toast
$this->flareDanger(string $text, ?string $heading = null, int $duration = 5000, ?string $position = null): void

// Error toast (alias)
$this->flareError(string $text, ?string $heading = null, int $duration = 5000, ?string $position = null): void

// Info toast
$this->flareInfo(string $text, ?string $heading = null, int $duration = 5000, ?string $position = null): void
```

### JavaScript API Methods

```javascript
// Basic toast
Flare.toast(text, options)

// Variant methods
Flare.success(text, options)
Flare.warning(text, options)
Flare.danger(text, options)
Flare.error(text, options)  // Alias for danger
```

**Options Object:**
```javascript
{
    heading: 'Optional Heading',     // Toast title
    variant: 'success',               // success, warning, danger, info
    duration: 5000,                   // Duration in ms (0 = persistent)
    position: 'bottom end'            // Toast position
}
```

---

## ⚙️ Configuration

The configuration file `config/flare.php` provides extensive customization options:

```php
return [
    /*
    |--------------------------------------------------------------------------
    | Default Toast Position
    |--------------------------------------------------------------------------
    | Choose where toasts appear on screen.
    | Options: 'top start', 'top center', 'top end',
    |          'bottom start', 'bottom center', 'bottom end'
    */
    'position' => env('FLARE_POSITION', 'bottom end'),

    /*
    |--------------------------------------------------------------------------
    | Default Duration
    |--------------------------------------------------------------------------
    | How long toasts remain visible (in milliseconds).
    | Set to 0 for persistent toasts that must be manually dismissed.
    */
    'duration' => env('FLARE_DURATION', 5000),

    /*
    |--------------------------------------------------------------------------
    | Maximum Visible Toasts
    |--------------------------------------------------------------------------
    | Maximum number of toasts displayed simultaneously.
    | Additional toasts will be queued.
    */
    'max_visible' => env('FLARE_MAX_VISIBLE', 3),

    /*
    |--------------------------------------------------------------------------
    | Stack Expanded Mode
    |--------------------------------------------------------------------------
    | When true, all toasts are shown expanded.
    | When false, toasts stack with "X more" indicator.
    */
    'stack_expanded' => env('FLARE_STACK_EXPANDED', false),

    /*
    |--------------------------------------------------------------------------
    | Asset Paths
    |--------------------------------------------------------------------------
    | Paths to Flare's JavaScript and CSS files.
    */
    'asset_path' => env('FLARE_ASSET_PATH', '/vendor/flare/flare.js'),
    'css_path' => env('FLARE_CSS_PATH', '/vendor/flare/flare.css'),
];
```

### Environment Variables

You can also configure Flare using `.env` variables:

```env
FLARE_POSITION="top center"
FLARE_DURATION=7000
FLARE_MAX_VISIBLE=5
FLARE_STACK_EXPANDED=true
```

---

## 🎨 Toast Variants

Flare provides four beautiful variants for different notification types:

| Variant | Usage | Color | Best For |
|---------|-------|-------|----------|
| `success` | `Flare::success()` | 🟢 Green | Successful operations, confirmations |
| `warning` | `Flare::warning()` | 🟡 Yellow | Warnings, cautionary messages |
| `danger` | `Flare::danger()` | 🔴 Red | Errors, critical alerts |
| `info` | `Flare::info()` | 🔵 Blue | Informational messages, tips |

**Examples:**

```php
// Success - User action completed
Flare::success('Profile updated successfully!');

// Warning - Important but not critical
Flare::warning('Your session will expire in 5 minutes');

// Danger - Critical errors
Flare::danger('Failed to save changes', 'Error');

// Info - Helpful information
Flare::info('New features are available!');
```

---

## 📍 Toast Positions

Flare supports 6 different positions on the screen:

<div align="center">

```
┌─────────────────────────────────────┐
│  top start    top center    top end │
│                                      │
│                                      │
│                                      │
│ bottom start bottom center bottom end│
└─────────────────────────────────────┘
```

</div>

**Available Positions:**
- `top start` - Top left corner
- `top center` - Top center
- `top end` - Top right corner
- `bottom start` - Bottom left corner
- `bottom center` - Bottom center
- `bottom end` - Bottom right corner (default)

**Usage:**

```php
// Set position globally in config
'position' => 'top center',

// Or set per-toast
Flare::success('Message', null, 5000, 'top center');
$this->flareSuccess('Message', null, 5000, 'top center');
```

---

## ⏱️ Duration & Auto-Dismiss

Control how long toasts remain visible:

```php
// Default duration (5000ms = 5 seconds)
Flare::success('Quick message');

// Custom duration (2 seconds)
Flare::success('Fast message', null, 2000);

// Longer duration (10 seconds)
Flare::warning('Important warning', null, 10000);

// Persistent toast (never auto-dismiss)
Flare::danger('Critical error - manual dismiss required', null, 0);
```

**Features:**
- ⏸️ Hover over toast to pause auto-dismiss
- ▶️ Mouse leave resumes the timer
- 🖱️ Click dismiss button to close manually
- ⌨️ Use keyboard shortcuts (see below)

---

## ⌨️ Keyboard Navigation

Flare includes powerful keyboard shortcuts for better accessibility:

| Shortcut | Action |
|----------|--------|
| `Esc` | Dismiss the most recent toast |
| `Shift + Esc` | Dismiss all toasts |
| `Alt + D` | Dismiss all toasts (alternative) |

```javascript
// These work automatically - no configuration needed!
```

---

## 🎯 Advanced Usage

### Stack Management

When multiple toasts are shown, Flare intelligently manages the stack:

```php
// Show multiple toasts
Flare::success('First toast');
Flare::warning('Second toast');
Flare::info('Third toast');
Flare::danger('Fourth toast');

// With max_visible = 3, the fourth toast will queue
// and appear when one of the first three is dismissed
```

### Custom Component Configuration

Override default settings per component:

```blade
<!-- Expanded stack with top center position -->
<livewire:flare-toasts
    position="top center"
    :expanded="true"
/>

<!-- Custom max visible toasts -->
<x-flare::toast-group
    position="bottom start"
    :max-visible="5"
    :expanded="false"
/>
```

### Toast with All Options

```php
use AlizHarb\Flare\Facades\Flare;

Flare::toast(
    text: 'Your report has been generated and is ready for download.',
    heading: 'Report Ready',
    duration: 10000,
    variant: 'success',
    position: 'top center'
);
```

### Livewire Example: Form Validation

```php
use Livewire\Component;
use AlizHarb\Flare\Concerns\WithFlare;

class ContactForm extends Component
{
    use WithFlare;

    public $name;
    public $email;
    public $message;

    public function submit()
    {
        $validated = $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'message' => 'required|min:10',
        ]);

        // Send email logic here...

        $this->flareSuccess(
            'Thank you! We\'ll get back to you soon.',
            'Message Sent',
            duration: 7000,
            position: 'top center'
        );

        $this->reset();
    }

    public function updated($field)
    {
        // Show validation errors as toasts
        try {
            $this->validateOnly($field);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $error = $e->validator->errors()->first($field);
            $this->flareWarning($error, 'Validation Error', 4000);
        }
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
```

### Queue Multiple Toasts

```php
// All toasts will be queued and shown progressively
foreach ($users as $user) {
    Flare::success("Notification sent to {$user->name}");
}
```

### JavaScript Event Listening

```javascript
// Listen for toast events (advanced use case)
window.addEventListener('flare-toast-show', (event) => {
    console.log('Toast triggered:', event.detail);

    // You can track analytics, etc.
});
```

---

## 🎨 Customization

### Custom Styles

Publish the views and customize the HTML/CSS:

```bash
php artisan vendor:publish --tag=flare-views
```

Edit the published views in `resources/views/vendor/flare/`:

```blade
<!-- resources/views/vendor/flare/components/toast.blade.php -->
<!-- Customize the toast HTML structure -->
```

### Custom CSS

Publish the assets and modify the CSS:

```bash
php artisan vendor:publish --tag=flare-assets
```

Edit `public/vendor/flare/flare.css` to match your brand colors.

### Dark Mode Support

Flare automatically adapts to dark mode. You can customize dark mode styles:

```css
/* Custom dark mode colors */
@media (prefers-color-scheme: dark) {
    .flare-toast.success {
        background: #1a472a;
        color: #86efac;
    }
}
```

---

## 🧪 Testing

Flare includes a comprehensive test suite using Pest:

```bash
# Run all tests
composer test

# Run tests with coverage
composer test-coverage

# Run static analysis
composer analyse

# Format code
composer format
```

### Writing Tests for Your App

```php
use AlizHarb\Flare\Facades\Flare;

it('shows success toast on user creation', function () {
    Flare::shouldReceive('success')
        ->once()
        ->with('User created successfully!');

    $this->post('/users', $userData);
});
```

---

## 🔍 Troubleshooting

### Toasts not appearing?

**1. Check if scripts are loaded:**
```blade
<!-- Make sure these are in your layout -->
@flareScripts
@flareStyles
```

**2. Verify the component is present:**
```blade
<!-- Should be in your layout, typically before closing body tag -->
<livewire:flare-toasts />
```

**3. Check browser console for errors:**
```javascript
// Verify Flare is loaded
console.log(window.Flare);  // Should show object with methods
```

**4. Ensure Alpine.js is loaded:**
Livewire 3 includes Alpine.js by default. Verify in browser console:
```javascript
console.log(window.Alpine);  // Should be defined
```

### Styling issues?

Make sure CSS is loaded before custom styles:
```blade
@flareStyles
<!-- Your custom styles here -->
```

### Toasts appearing in wrong position?

Check your configuration:
```php
// config/flare.php
'position' => 'bottom end',  // Verify this is correct
```

---

## 🤝 Contributing

We welcome contributions! Please see [CONTRIBUTING.md](CONTRIBUTING.md) for details.

### Development Setup

```bash
# Clone the repository
git clone https://github.com/alizharb/flare.git

# Install dependencies
composer install

# Run tests
composer test

# Run static analysis
composer analyse

# Format code
composer format
```

### Contribution Guidelines

- ✅ Write tests for new features
- ✅ Follow PSR-12 coding standards
- ✅ Update documentation
- ✅ Ensure all tests pass
- ✅ Add entries to CHANGELOG.md

---

## 📝 Changelog

Please see [CHANGELOG.md](CHANGELOG.md) for recent changes.

---

## 🔒 Security

If you discover any security-related issues, please email **harbzali@gmail.com** instead of using the issue tracker.

---

## 🙏 Credits

- **[Ali Harb](https://github.com/alizharb)** - Creator & Maintainer
- **[All Contributors](../../contributors)** - Thank you!

### Built With

- [Laravel](https://laravel.com) - The PHP Framework
- [Livewire](https://livewire.laravel.com) - Full-stack framework for Laravel
- [Alpine.js](https://alpinejs.dev) - Lightweight JavaScript framework
- [Tailwind CSS](https://tailwindcss.com) - Utility-first CSS framework (optional)

---

## 📄 License

Flare is open-sourced software licensed under the [MIT license](LICENSE).

---

## 💖 Support

If you find this package helpful, please consider:

- ⭐ Starring the repository
- 🐛 Reporting bugs and issues
- 💡 Suggesting new features
- 📖 Improving documentation
- 🤝 Contributing code

---

## 🔗 Links

- **Documentation**: [Full Documentation](https://github.com/alizharb/flare#readme)
- **Issues**: [GitHub Issues](https://github.com/alizharb/flare/issues)
- **Discussions**: [GitHub Discussions](https://github.com/alizharb/flare/discussions)
- **Changelog**: [Releases](https://github.com/alizharb/flare/releases)

---

<div align="center">

**Made with ❤️ by [Ali Harb](https://github.com/alizharb)**

If you like this package, please ⭐ star it on [GitHub](https://github.com/alizharb/flare)!

</div>
