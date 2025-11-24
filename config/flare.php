<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Toast Position
    |--------------------------------------------------------------------------
    |
    | This value determines the default position for toast notifications.
    | Supported positions: "bottom end", "bottom center", "bottom start",
    | "top end", "top center", "top start"
    |
    */

    'position' => env('FLARE_POSITION', 'bottom end'),

    /*
    |--------------------------------------------------------------------------
    | Toast Theme
    |--------------------------------------------------------------------------
    |
    | Choose the visual theme for toast notifications.
    | Available themes: "classic", "modern", "vibrant"
    | - classic: Minimal, clean design with solid colors and simple shadows
    | - modern: Balanced design with subtle gradients and light effects
    | - vibrant: Bold, colorful design with strong gradients and glowing effects
    |
    */

    'theme' => env('FLARE_THEME', 'modern'),

    /*
    |--------------------------------------------------------------------------
    | Default Toast Duration
    |--------------------------------------------------------------------------
    |
    | The default duration in milliseconds for toast notifications.
    | Set to 0 for persistent toasts (must be dismissed manually).
    |
    */

    'duration' => env('FLARE_DURATION', 5000),

    /*
    |--------------------------------------------------------------------------
    | Max Visible Toasts
    |--------------------------------------------------------------------------
    |
    | The maximum number of toasts to display at once.
    | Additional toasts will be queued and shown as others are dismissed.
    |
    */

    'max_visible' => env('FLARE_MAX_VISIBLE', 3),

    /*
    |--------------------------------------------------------------------------
    | Stack Expanded Mode
    |--------------------------------------------------------------------------
    |
    | When true, all toasts are shown expanded by default.
    | When false, only the last 3 toasts are visible with a stacking effect.
    | Users can hover to expand all toasts.
    |
    */

    'stack_expanded' => env('FLARE_STACK_EXPANDED', false),

    /*
    |--------------------------------------------------------------------------
    | Enable Stacking
    |--------------------------------------------------------------------------
    |
    | When true, multiple toasts will stack with a visual layering effect.
    | When false, toasts are displayed in a simple vertical list.
    | This works in conjunction with stack_expanded.
    |
    */

    'enable_stacking' => env('FLARE_ENABLE_STACKING', true),

    /*
    |--------------------------------------------------------------------------
    | Custom Icons
    |--------------------------------------------------------------------------
    |
    | Enable custom icons for toast variants. When enabled, you can pass
    | custom icon HTML or SVG strings to toast notifications.
    |
    */

    'icons' => [
        'enabled' => env('FLARE_ICONS_ENABLED', true),
        'success' => null, // null = use default
        'warning' => null,
        'danger' => null,
        'info' => null,
    ],

    /*
    |--------------------------------------------------------------------------
    | Action Buttons
    |--------------------------------------------------------------------------
    |
    | Enable action buttons in toast notifications. Allows adding clickable
    | actions like "Undo", "View", "Retry", etc.
    |
    */

    'actions' => [
        'enabled' => env('FLARE_ACTIONS_ENABLED', true),
        'max_per_toast' => 2, // Maximum action buttons per toast
    ],

    /*
    |--------------------------------------------------------------------------
    | Priority System
    |--------------------------------------------------------------------------
    |
    | Enable priority-based toast ordering. Higher priority toasts appear
    | first in the queue. Priorities: low (0), normal (1), high (2), urgent (3)
    |
    */

    'priority' => [
        'enabled' => env('FLARE_PRIORITY_ENABLED', true),
        'default' => 1, // normal priority
    ],

    /*
    |--------------------------------------------------------------------------
    | Rate Limiting
    |--------------------------------------------------------------------------
    |
    | Prevent toast spam by limiting the number of toasts shown within
    | a specific time window.
    |
    */

    'rate_limit' => [
        'enabled' => env('FLARE_RATE_LIMIT_ENABLED', true),
        'max_toasts' => 10, // Maximum toasts
        'time_window' => 60, // Time window in seconds
    ],

    /*
    |--------------------------------------------------------------------------
    | Toast History
    |--------------------------------------------------------------------------
    |
    | Keep a history of dismissed toasts. Users can view previously
    | dismissed notifications.
    |
    */

    'history' => [
        'enabled' => env('FLARE_HISTORY_ENABLED', false),
        'max_items' => 50, // Maximum history items to keep
    ],

    /*
    |--------------------------------------------------------------------------
    | Sound Notifications
    |--------------------------------------------------------------------------
    |
    | Play sound effects when toasts appear. Useful for important alerts.
    |
    */

    'sound' => [
        'enabled' => env('FLARE_SOUND_ENABLED', false),
        'success' => null, // Path to sound file
        'warning' => null,
        'danger' => null,
        'info' => null,
    ],

    /*
    |--------------------------------------------------------------------------
    | Progress Bar
    |--------------------------------------------------------------------------
    |
    | Show a visual progress bar for auto-dismissing toasts.
    |
    */

    'progress_bar' => [
        'enabled' => env('FLARE_PROGRESS_BAR_ENABLED', true),
        'position' => 'bottom', // top or bottom
    ],

    /*
    |--------------------------------------------------------------------------
    | Asset Paths
    |--------------------------------------------------------------------------
    |
    | The paths to the Flare JavaScript and CSS files. These are used by the
    | @flareScripts and @flareStyles directives.
    |
    */

    'asset_path' => env('FLARE_ASSET_PATH', 'vendor/alizharb/flare/flare.js'),
    'css_path' => env('FLARE_CSS_PATH', 'vendor/alizharb/flare/flare.css'),

];
