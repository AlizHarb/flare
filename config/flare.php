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
    | Users can click "X more notifications" to expand all toasts.
    |
    */

    'stack_expanded' => env('FLARE_STACK_EXPANDED', false),

    /*
    |--------------------------------------------------------------------------
    | Asset Paths
    |--------------------------------------------------------------------------
    |
    | The paths to the Flare JavaScript and CSS files. These are used by the
    | @flareScripts and @flareStyles directives.
    |
    */

    'asset_path' => env('FLARE_ASSET_PATH', '/vendor/flare/flare.js'),
    'css_path' => env('FLARE_CSS_PATH', '/vendor/flare/flare.css'),

];
