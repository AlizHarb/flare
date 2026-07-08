# Upgrading from v1.0 to v1.1

This guide will help you upgrade from Flare v1.0 to v1.1.

## Overview

Flare v1.1 is a feature-packed release that adds action buttons, priority ordering, rate limiting, toast templates, and many other enhancements. **There are no breaking changes** except for users who were using `<x-flare::` syntax (which was never officially documented).

## Requirements

- PHP 8.3+ (unchanged)
- Laravel 12.0+ or 13.0+
- Livewire 3.5+ or 4.0+

## Step-by-Step Upgrade

### 1. Update Composer

```bash
composer update alizharb/flare
```

### 2. Publish New Configuration (Optional)

If you want to use the new features, publish the updated configuration:

```bash
php artisan vendor:publish --tag=flare-config --force
```

**Note**: This will overwrite your existing `config/flare.php`. If you have custom settings, back them up first.

### 3. Publish New Assets (Optional)

If you published assets previously, update them:

```bash
php artisan vendor:publish --tag=flare-assets --force
```

### 4. Component Syntax (No Changes Required)

The component syntax remains:

```blade
{{-- Livewire Component --}}
<livewire:flare-toasts />

{{-- Blade Components --}}
<flare::toast />
<flare::toast.group>
    <flare::toast />
</flare::toast.group>
```

## New Features You Can Use

### 1. Action Buttons

Add clickable actions to your toasts:

```php
use AlizHarb\Flare\Facades\Flare;

Flare::success('File uploaded!', options: [
    'actions' => [
        ['label' => 'View', 'url' => '/files/123'],
        ['label' => 'Undo', 'callback' => 'undoUpload'],
    ]
]);
```

### 2. Priority System

Control toast ordering:

```php
// High priority toast appears first
Flare::danger('Critical error!', options: ['priority' => 'urgent']);

// Normal priority
Flare::success('Saved successfully');
```

### 3. Toast Templates

Use pre-built templates:

```php
// PHP
Flare::template('saved', ['message' => 'Profile updated']);

// Livewire
$this->flareTemplate('deleted', ['message' => 'User removed']);

// JavaScript
Flare.template('loading', { message: 'Processing payment...' });
```

### 4. Custom Icons

Override default icons:

```php
Flare::success('Done!', options: [
    'icon' => '<svg>...</svg>'
]);
```

### 5. Toast Grouping

Group related toasts:

```php
Flare::info('Processing item 1', options: ['group' => 'batch-process']);
Flare::info('Processing item 2', options: ['group' => 'batch-process']);

// Dismiss all toasts in a group
// JavaScript: dismissGroup('batch-process')
```

## Configuration Changes

### New Config Options

The following new configuration options are available in `config/flare.php`:

```php
'icons' => [
    'enabled' => true,
],

'actions' => [
    'enabled' => true,
    'max_per_toast' => 2,
],

'priority' => [
    'enabled' => true,
    'default' => 1,
],

'rate_limit' => [
    'enabled' => true,
    'max_toasts' => 10,
    'time_window' => 60,
],

'history' => [
    'enabled' => false,
    'max_items' => 50,
],

'sound' => [
    'enabled' => false,
],

'progress_bar' => [
    'enabled' => true,
    'position' => 'bottom',
],
```

### Disabling New Features

If you want to disable any new features:

```php
// In config/flare.php
'actions' => [
    'enabled' => false,  // Disable action buttons
],

'priority' => [
    'enabled' => false,  // Disable priority system
],
```

## TypeScript Support

If you're using TypeScript, import the type definitions:

```typescript
/// <reference path="./vendor/flare/flare.d.ts" />

// Now you have full type safety
Flare.success("Hello!", {
  heading: "Success",
  duration: 3000,
  actions: [{ label: "View", url: "/view" }],
});
```

## Testing Your Upgrade

After upgrading, test the following:

1. **Basic Toasts**: Ensure existing toasts still work

   ```php
   Flare::success('Test toast');
   ```

2. **Livewire Integration**: Test in Livewire components

   ```php
   $this->flareSuccess('Livewire test');
   ```

3. **JavaScript API**: Test client-side toasts

   ```javascript
   Flare.success("JS test");
   ```

4. **New Features**: Try action buttons and templates
   ```php
   Flare::template('saved');
   ```

## Troubleshooting

### Toasts Not Showing

1. Clear your browser cache
2. Republish assets: `php artisan vendor:publish --tag=flare-assets --force`
3. Check browser console for errors

### Action Buttons Not Working

1. Ensure actions are enabled in config: `'actions.enabled' => true`
2. Check that you're passing actions correctly:
   ```php
   'actions' => [
       ['label' => 'Click me', 'url' => '/path']
   ]
   ```

### Progress Bar Not Showing

1. Check config: `'progress_bar.enabled' => true`
2. Ensure toast has a duration > 0

## Need Help?

- **Documentation**: [README.md](README.md)
- **Issues**: [GitHub Issues](https://github.com/alizharb/flare/issues)
- **Discussions**: [GitHub Discussions](https://github.com/alizharb/flare/discussions)

## Summary

Flare v1.1 is a backward-compatible upgrade that adds powerful new features while maintaining the simplicity you love. All existing code will continue to work without modifications.

**Enjoy the new features! 🔥**
