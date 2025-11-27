# Advanced Usage

Take your notifications to the next level with these advanced features.

## Stacking System

Flare features a smart stacking system that prevents your screen from being flooded with notifications.

<div class="flex items-center gap-4 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-100 dark:border-blue-800 mb-8">
    <div class="flex-shrink-0">
        <svg class="w-6 h-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
    </div>
    <div>
        <h4 class="font-bold text-blue-900 dark:text-blue-100">How it works</h4>
        <p class="text-sm text-blue-800 dark:text-blue-200">
            When <strong>Stacking</strong> is enabled (default), toasts stack on top of each other in 3D space. Only the top few toasts are visible. Hovering over the stack expands it to show all notifications.
        </p>
    </div>
</div>

You can disable stacking in `config/flare.php`:

```php
'stacking' => false,
```

## Custom Sounds

You can play a sound when a notification appears.

1.  Enable sounds in `config/flare.php`.
2.  Configure the paths to your sound files.

```php
'sounds' => [
    'enabled' => true,
    'success' => '/sounds/success.mp3',
    // ...
],
```

Or play a specific sound for one toast:

```php
Flare::success('Cha-ching!', [
    'sound' => '/sounds/cash-register.mp3'
]);
```

## Browser Events

Flare emits custom browser events that you can listen to in your JavaScript.

### `flare-toast-show`

Dispatched when a toast is triggered.

```javascript
window.addEventListener("flare-toast-show", (event) => {
    console.log("New toast:", event.detail);
    // event.detail contains: { id, text, type, ... }
});
```

## Custom Icons

You can use your own SVG icons instead of the default ones by passing an SVG string.

```php
Flare::info('Custom Icon', [
    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" /></svg>'
]);
```
