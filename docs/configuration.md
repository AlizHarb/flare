# Configuration

Complete configuration reference for Flare.

## Configuration File

Publish the configuration file:

```bash
php artisan vendor:publish --tag=flare-config
```

This creates `config/flare.php` with all available options.

## Complete Configuration

```php
<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Toast Theme
    |--------------------------------------------------------------------------
    | Choose the visual theme for toast notifications.
    | Options: "classic", "modern", "vibrant"
    */
    'theme' => env('FLARE_THEME', 'modern'),

    /*
    |--------------------------------------------------------------------------
    | Default Toast Position
    |--------------------------------------------------------------------------
    | Choose where toasts appear on screen.
    | Options: "top start", "top center", "top end",
    |          "bottom start", "bottom center", "bottom end"
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
    | Enable Stacking
    |--------------------------------------------------------------------------
    | When true, multiple toasts will stack with a visual layering effect.
    | When false, toasts are displayed in a simple vertical list.
    */
    'enable_stacking' => env('FLARE_ENABLE_STACKING', true),

    /*
    |--------------------------------------------------------------------------
    | Stack Expanded Mode
    |--------------------------------------------------------------------------
    | When true, all toasts are shown expanded by default.
    | When false, toasts stack and expand on hover.
    | Only applies when enable_stacking is true.
    */
    'stack_expanded' => env('FLARE_STACK_EXPANDED', false),

    /*
    |--------------------------------------------------------------------------
    | Custom Icons
    |--------------------------------------------------------------------------
    | Enable custom icons for toast variants.
    */
    'icons' => [
        'enabled' => env('FLARE_ICONS_ENABLED', true),
    ],

    /*
    |--------------------------------------------------------------------------
    | Action Buttons
    |--------------------------------------------------------------------------
    | Enable action buttons in toast notifications.
    */
    'actions' => [
        'enabled' => env('FLARE_ACTIONS_ENABLED', true),
        'max_per_toast' => 2,
    ],

    /*
    |--------------------------------------------------------------------------
    | Priority System
    |--------------------------------------------------------------------------
    | Enable priority-based toast ordering.
    */
    'priority' => [
        'enabled' => env('FLARE_PRIORITY_ENABLED', true),
        'default' => 1, // normal priority
    ],

    /*
    |--------------------------------------------------------------------------
    | Rate Limiting
    |--------------------------------------------------------------------------
    | Prevent toast spam by limiting the number of toasts shown.
    */
    'rate_limit' => [
        'enabled' => env('FLARE_RATE_LIMIT_ENABLED', true),
        'max_toasts' => 10,
        'time_window' => 60, // seconds
    ],

    /*
    |--------------------------------------------------------------------------
    | Progress Bar
    |--------------------------------------------------------------------------
    | Show a visual progress bar for auto-dismissing toasts.
    */
    'progress_bar' => [
        'enabled' => env('FLARE_PROGRESS_BAR_ENABLED', true),
        'position' => 'bottom', // top or bottom
    ],

    /*
    |--------------------------------------------------------------------------
    | Asset Paths
    |--------------------------------------------------------------------------
    | Paths to Flare's JavaScript and CSS files.
    */
    'asset_path' => env('FLARE_ASSET_PATH', 'vendor/alizharb/flare/flare.js'),
    'css_path' => env('FLARE_CSS_PATH', 'vendor/alizharb/flare/flare.css'),
];
```

## Environment Variables

Configure Flare using `.env` variables:

```env
# Theme
FLARE_THEME=modern

# Position
FLARE_POSITION="bottom end"

# Duration (milliseconds)
FLARE_DURATION=5000

# Stacking
FLARE_ENABLE_STACKING=true
FLARE_STACK_EXPANDED=false
FLARE_MAX_VISIBLE=3

# Features
FLARE_ICONS_ENABLED=true
FLARE_ACTIONS_ENABLED=true
FLARE_PRIORITY_ENABLED=true
FLARE_RATE_LIMIT_ENABLED=true
FLARE_PROGRESS_BAR_ENABLED=true
```

## Configuration Options Explained

### Theme

Choose the visual style:

- `classic` - Minimal, professional
- `modern` - Balanced, contemporary (default)
- `vibrant` - Bold, colorful

### Position

Where toasts appear:

- `top start` - Top left
- `top center` - Top center
- `top end` - Top right
- `bottom start` - Bottom left
- `bottom center` - Bottom center
- `bottom end` - Bottom right (default)

### Duration

How long toasts are visible (milliseconds):

- `5000` - 5 seconds (default)
- `0` - Persistent (manual dismiss only)
- Any positive number

### Max Visible

Maximum toasts shown at once:

- `3` - Default
- Additional toasts are queued

### Enable Stacking

Visual layering effect:

- `true` - Toasts stack with layering (default)
- `false` - Simple vertical list

### Stack Expanded

Default expansion state (when stacking enabled):

- `false` - Start collapsed, expand on hover (default)
- `true` - Always expanded

### Icons

Show variant-specific icons:

- `true` - Show icons (default)
- `false` - No icons

### Actions

Enable action buttons:

- `true` - Allow action buttons (default)
- `false` - No action buttons

### Priority

Priority-based ordering:

- `true` - Enable priority system (default)
- `false` - Disable

### Rate Limiting

Prevent toast spam:

- `enabled` - Enable rate limiting (default: true)
- `max_toasts` - Max toasts per time window (default: 10)
- `time_window` - Time window in seconds (default: 60)

### Progress Bar

Visual progress indicator:

- `enabled` - Show progress bar (default: true)
- `position` - `top` or `bottom` (default: bottom)

## Per-Toast Overrides

You can override configuration per toast:

```php
// Override position
Flare::success('Message', position: 'top center');

// Override duration
Flare::warning('Alert', duration: 10000);

// Override both
Flare::info(
    text: 'Notice',
    duration: 7000,
    position: 'bottom start'
);
```

## Component-Level Configuration

Override settings for specific components:

```blade
<!-- Custom position and stacking -->
<flare::toasts
    position="top center"
    :expanded="true"
/>
```

## Next Steps

- [Themes](themes.md) - Choose your visual style
- [Positioning](positioning.md) - Toast placement
- [API Reference](api-reference.md) - All methods
- [Examples](examples.md) - Real-world use cases
