# Configuration

Flare is designed to be zero-config, but it's also highly customizable. You can publish the configuration file to change global defaults.

## Publishing Config

Run the following command to publish the `flare.php` config file:

```bash
php artisan vendor:publish --tag=flare-config
```

## Configuration Options

Here is the default configuration file with explanations:

```php
return [

    /*
    |--------------------------------------------------------------------------
    | Default Theme
    |--------------------------------------------------------------------------
    |
    | The visual theme to use for notifications.
    | Options: 'classic', 'modern', 'vibrant'
    |
    */
    'theme' => 'modern',

    /*
    |--------------------------------------------------------------------------
    | Default Position
    |--------------------------------------------------------------------------
    |
    | Where the notifications should appear on the screen.
    | Options: 'top-left', 'top-center', 'top-right',
    |          'bottom-left', 'bottom-center', 'bottom-right'
    |
    */
    'position' => 'bottom-right',

    /*
    |--------------------------------------------------------------------------
    | Default Duration
    |--------------------------------------------------------------------------
    |
    | How long (in milliseconds) a toast should stay visible.
    | Set to 0 for persistent toasts.
    |
    */
    'duration' => 5000,

    /*
    |--------------------------------------------------------------------------
    | Stacking
    |--------------------------------------------------------------------------
    |
    | If true, toasts will stack on top of each other to save space.
    | If false, they will appear in a list.
    |
    */
    'stacking' => true,

    /*
    |--------------------------------------------------------------------------
    | Max Visible Toasts
    |--------------------------------------------------------------------------
    |
    | The maximum number of toasts to show at once when not stacked.
    |
    */
    'max_visible' => 5,

    /*
    |--------------------------------------------------------------------------
    | Play Sounds
    |--------------------------------------------------------------------------
    |
    | Whether to play a subtle sound when a notification appears.
    |
    */
    'sounds' => [
        'enabled' => false,
        'success' => '/vendor/flare/sounds/success.mp3',
        'error' => '/vendor/flare/sounds/error.mp3',
        'warning' => '/vendor/flare/sounds/warning.mp3',
        'info' => '/vendor/flare/sounds/info.mp3',
    ],

];
```

## Runtime Configuration

You can also override these settings at runtime using the `Flare` facade methods. See the [API Reference](api-reference) for more details.
