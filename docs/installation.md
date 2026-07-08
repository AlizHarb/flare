# Installation

Getting started with Flare is a breeze. Follow these simple steps to integrate beautiful toast notifications into your Laravel application.

## Requirements

| Requirement   | Version           |
| :------------ | :---------------- |
| **PHP**       | `^8.3`             |
| **Laravel**   | `^12.0` or `^13.0` |
| **Livewire**  | `^3.5` or `^4.0`   |
| **Alpine.js** | 3.x               |
| **Tailwind**  | 4.x               |

## Step 1: Install via Composer

Require the package using Composer:

```bash
composer require alizharb/flare
```

## Step 2: Add the Component

Add the `<x-flare::toast />` component to your main layout file. This is usually located at `resources/views/components/layouts/app.blade.php`.

> [!TIP]
> Place the component near the end of the `<body>` tag to ensure it renders on top of other content.

```html
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- ... -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        {{ $slot }}

        <!-- Add Flare Component Here -->
        <x-flare::toast />

        @livewireScripts
    </body>
</html>
```

## Step 3: Build Assets (Optional)

If you are using the default styling, **you're good to go!** Flare injects its styles automatically.

However, if you want to customize the styles or use the Tailwind classes directly in your build process, you can publish the views and assets.

```bash
php artisan vendor:publish --tag=flare-views
```

## Upgrading

When upgrading to a new version of Flare, make sure to republish the assets if you have previously published them:

```bash
php artisan vendor:publish --tag=flare-assets --force
```

## Troubleshooting

<div class="space-y-4">
<details class="collapsible">
<summary>
<span>Notifications not appearing?</span>
<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
</summary>
<div class="collapsible-content">
Ensure that <strong>Alpine.js</strong> is properly loaded in your layout. Livewire 3 includes Alpine by default, but if you've disabled it or are manually including it, make sure it's initialized.
</div>
</details>
<details class="collapsible">
<summary>
<span>Styles looking wrong?</span>
<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
</summary>
<div class="collapsible-content">
Check if you are including the vendor directory in your CSS file using the <code>@source</code> directive:
<pre class="mt-2 bg-gray-900 text-gray-100 p-3 rounded-lg overflow-x-auto"><code>@source "../vendor/alizharb/flare/resources/views/**/*.blade.php";</code></pre>

</div>
</details>
</div>
