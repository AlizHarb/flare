# Quick Start

Ready to show your first notification? Let's go!

## Basic Usage

The easiest way to use Flare is through the `Flare` facade. You can call it from any Livewire component or Controller.

```php
use AlizHarb\Flare\Facades\Flare;

class UserProfile extends Component
{
    public function update()
    {
        // ... update logic ...

        Flare::success('Profile updated successfully!');
    }
}
```

## Notification Types

Flare comes with 4 built-in notification types, each with its own distinct visual style.

<div class="grid grid-cols-1 md:grid-cols-2 gap-4 not-prose my-8">
<div class="p-4 rounded-lg bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800">
<h4 class="font-bold text-green-700 dark:text-green-400 mb-2">Success</h4>
<p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Used for positive actions like saving data.</p>
<div class="bg-gray-900 rounded-md p-3 overflow-x-auto">
<code class="text-xs text-green-400">Flare::success('Data saved!');</code>
</div>
</div>

<div class="p-4 rounded-lg bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800">
<h4 class="font-bold text-red-700 dark:text-red-400 mb-2">Error / Danger</h4>
<p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Used for critical errors or failures.</p>
<div class="bg-gray-900 rounded-md p-3 overflow-x-auto">
<code class="text-xs text-red-400">Flare::error('Something went wrong.');</code>
</div>
</div>

<div class="p-4 rounded-lg bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800">
<h4 class="font-bold text-yellow-700 dark:text-yellow-400 mb-2">Warning</h4>
<p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Used for non-critical issues.</p>
<div class="bg-gray-900 rounded-md p-3 overflow-x-auto">
<code class="text-xs text-yellow-400">Flare::warning('Battery low.');</code>
</div>
</div>

<div class="p-4 rounded-lg bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800">
<h4 class="font-bold text-blue-700 dark:text-blue-400 mb-2">Info</h4>
<p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Used for general information.</p>
<div class="bg-gray-900 rounded-md p-3 overflow-x-auto">
<code class="text-xs text-blue-400">Flare::info('Update available.');</code>
</div>
</div>
</div>

## Adding a Title

You can add a bold title (heading) to any notification to give it more context:

```php
Flare::success(
    text: 'Your changes have been saved.',
    heading: 'Success!'
);
```

## Customizing Duration

By default, toasts disappear after 5 seconds. You can change this per toast:

```php
Flare::info(
    text: 'I will stay for 10 seconds.',
    duration: 10000 // milliseconds
);
```

> [!TIP]
> To make a toast persistent (never auto-dismiss), set duration to `0`.

```php
Flare::error(
    text: 'Network error. Please try again.',
    duration: 0
);
```
