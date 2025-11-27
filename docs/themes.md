# Themes

Flare comes with three distinct themes to match the aesthetic of your application. You can set the global theme in `config/flare.php` or override it per toast.

## Modern (Default)

The **Modern** theme features a balanced design with subtle glassmorphism effects, rounded corners, and soft shadows. It fits perfectly with most modern SaaS applications and dashboards.

<div class="p-6 rounded-xl bg-gray-100 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 not-prose my-6">
<div class="flex items-center gap-4 p-4 rounded-lg theme-modern max-w-sm">
<div class="flex-shrink-0 w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-600 dark:text-blue-400">
<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
</div>
<div>
<h4 class="font-semibold text-gray-900 dark:text-white">Modern Theme</h4>
<p class="text-sm text-gray-500 dark:text-gray-400">Clean, crisp, and beautiful.</p>
</div>
</div>
</div>

```php
Flare::info('This is the modern theme');
```

## Classic

The **Classic** theme is minimal, clean, and professional. It uses solid colors and standard borders, making it ideal for enterprise applications or data-heavy interfaces where clarity is paramount.

<div class="p-6 rounded-xl bg-gray-100 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 not-prose my-6">
<div class="flex items-center gap-4 p-4 rounded theme-classic theme-classic-success max-w-sm">
<div class="flex-shrink-0 text-green-500">
<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
</div>
<div>
<h4 class="font-bold text-gray-900 dark:text-white">Classic Theme</h4>
<p class="text-sm text-gray-600 dark:text-gray-400">Simple and effective.</p>
</div>
</div>
</div>

```php
Flare::success('This is the classic theme', ['theme' => 'classic']);
```

## Vibrant

The **Vibrant** theme is bold and colorful. It uses gradients and high-contrast colors to ensure your notifications grab attention. Perfect for consumer-facing apps or marketing sites.

<div class="p-6 rounded-xl bg-gray-100 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 not-prose my-6">
<div class="flex items-center gap-4 p-4 rounded-lg theme-vibrant theme-vibrant-warning max-w-sm">
<div class="flex-shrink-0 text-white">
<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
</div>
<div class="text-white">
<h4 class="font-bold">Vibrant Theme</h4>
<p class="text-sm text-white/90">Impossible to miss.</p>
</div>
</div>
</div>

```php
Flare::warning('This is the vibrant theme', ['theme' => 'vibrant']);
```

## Changing Themes

### Global Configuration

Set the default theme in your `config/flare.php` file:

```php
'theme' => 'vibrant',
```

### Per-Toast Override

You can override the theme for a specific notification using the `theme` option in the options array.

```php
Flare::toast('Custom Theme Toast', [
    'theme' => 'classic',
    'variant' => 'success'
]);
```
