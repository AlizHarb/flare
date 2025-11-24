# Installation

Get Flare up and running in your Laravel application in just a few minutes.

## Requirements

- **PHP**: 8.3 or higher
- **Laravel**: 12.0 or higher
- **Livewire**: 3.5 or higher
- **Alpine.js**: 3.x (included in Livewire 3)

## Step 1: Install via Composer

```bash
composer require alizharb/flare
```

## Step 2: Publish Assets (Required)

> **IMPORTANT**: You MUST publish the assets for Flare to work.

```bash
php artisan vendor:publish --tag=flare-assets
```

This copies JavaScript and CSS files to `public/vendor/alizharb/flare/`.

## Step 3: Add to Your Layout

Add Flare's scripts and styles to your main layout file:

```blade
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My App</title>

    <!-- Flare Styles (REQUIRED) -->
    @flareStyles
</head>
<body>
    {{ $slot }}

    <!-- Flare Scripts (REQUIRED) -->
    @flareScripts
</body>
</html>
```

## Step 4: Add Toast Component

Add the toast component to your layout (typically in your main layout):

```blade
<!-- Add this once in your layout -->
<flare::toasts />
```

That's it! You're ready to use Flare 🎉

## Optional: Publish Configuration

If you want to customize Flare's settings:

```bash
php artisan vendor:publish --tag=flare-config
```

This creates `config/flare.php` where you can configure:

- Default theme
- Default position
- Stacking behavior
- And more...

## Optional: Publish Views

To customize the toast component views:

```bash
php artisan vendor:publish --tag=flare-views
```

## Verification

Test your installation with a simple toast:

```php
use AlizHarb\Flare\Facades\Flare;

Route::get('/test', function () {
    Flare::success('Flare is working!');
    return view('welcome');
});
```

Visit `/test` and you should see a success toast notification.

## Troubleshooting

### Toasts Not Appearing

Make sure you have:

1. ✅ Published assets: `php artisan vendor:publish --tag=flare-assets`
2. ✅ Added `@flareStyles` in `<head>`
3. ✅ Added `@flareScripts` before `</body>`
4. ✅ Added `<flare::toasts />` component
5. ✅ Cleared cache: `php artisan optimize:clear`

### Assets Not Loading

```bash
# Re-publish assets
php artisan vendor:publish --tag=flare-assets --force

# Clear all caches
php artisan optimize:clear
```

## Next Steps

- [Quick Start](quick-start.md) - Create your first toast
- [Configuration](configuration.md) - Customize Flare
- [Themes](themes.md) - Choose your visual style
