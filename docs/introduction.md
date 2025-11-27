<div class="not-prose relative overflow-hidden rounded-3xl bg-gray-900 border border-gray-800 mb-12"><div class="absolute top-0 left-0 w-full h-full bg-gradient-to-br from-blue-500/20 via-purple-500/20 to-pink-500/20 opacity-50"></div><div class="absolute -top-24 -right-24 w-96 h-96 bg-blue-500/30 rounded-full blur-3xl"></div><div class="absolute -bottom-24 -left-24 w-96 h-96 bg-purple-500/30 rounded-full blur-3xl"></div><div class="relative z-10 p-12 text-center"><div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-white/20 text-white text-xs font-medium mb-6 backdrop-blur-md"><span>New Release</span><span class="w-1 h-1 rounded-full bg-white/50"></span><span>v1.0</span></div><h1 class="text-4xl md:text-6xl font-bold text-white mb-6 tracking-tight">The <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400">Ultimate</span> Toast<br/>for Livewire.</h1><p class="text-lg text-gray-300 mb-8 max-w-2xl mx-auto leading-relaxed">Beautiful, lightweight, and zero-config notifications designed to make your Laravel applications feel premium.</p><div class="flex flex-col sm:flex-row items-center justify-center gap-4"><a href="#" onclick="window.docsAppInstance.loadPage('installation'); return false;" class="px-8 py-4 rounded-xl bg-white text-gray-900 font-bold hover:scale-105 transition-transform duration-200">Get Started</a><a href="playground.html" class="px-8 py-4 rounded-xl bg-white/10 text-white border border-white/20 font-bold hover:bg-white/20 transition-colors duration-200 backdrop-blur-md">Live Demo</a></div></div></div>

## Why Flare?

In modern web applications, user feedback is crucial. Whether it's a success message after saving a form or an error alert when something goes wrong, how you communicate with your users matters.

Flare was built with three core principles in mind:

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 my-8 not-prose">
    <div class="p-6 rounded-xl bg-white dark:bg-gray-800/50 border border-gray-200 dark:border-gray-700 hover-card">
        <div class="w-10 h-10 rounded-lg bg-blue-50 dark:bg-blue-900/30 flex items-center justify-center mb-4 text-blue-500">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" /></svg>
        </div>
        <h3 class="font-bold text-gray-900 dark:text-white mb-2">Aesthetics First</h3>
        <p class="text-sm text-gray-500 dark:text-gray-400">Stunning out-of-the-box designs that make your app look premium immediately.</p>
    </div>
    <div class="p-6 rounded-xl bg-white dark:bg-gray-800/50 border border-gray-200 dark:border-gray-700 hover-card">
        <div class="w-10 h-10 rounded-lg bg-purple-50 dark:bg-purple-900/30 flex items-center justify-center mb-4 text-purple-500">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
        </div>
        <h3 class="font-bold text-gray-900 dark:text-white mb-2">Zero Config</h3>
        <p class="text-sm text-gray-500 dark:text-gray-400">Install, add the component, and start flashing. No complex setup required.</p>
    </div>
    <div class="p-6 rounded-xl bg-white dark:bg-gray-800/50 border border-gray-200 dark:border-gray-700 hover-card">
        <div class="w-10 h-10 rounded-lg bg-green-50 dark:bg-green-900/30 flex items-center justify-center mb-4 text-green-500">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        </div>
        <h3 class="font-bold text-gray-900 dark:text-white mb-2">Performance</h3>
        <p class="text-sm text-gray-500 dark:text-gray-400">Lightweight Alpine.js core ensures your app stays fast and responsive.</p>
    </div>
</div>

## Key Features

-   **Beautiful Themes**: Choose from Classic, Modern, or Vibrant.
-   **Stacking System**: Smart 3D stacking prevents screen clutter.
-   **Fully Responsive**: Looks great on mobile, tablet, and desktop.
-   **Dark Mode**: First-class support for dark mode.
-   **Custom Sounds**: Play subtle sounds on notification.
-   **Fluent API**: Expressive and easy-to-remember syntax.

## How it Works

Flare uses a lightweight Alpine.js component to render notifications on the client side, while providing a fluent PHP API to trigger them from your Livewire components or controllers.

```php
// In your Livewire component
public function save()
{
    $this->user->save();

    Flare::success('Profile updated successfully!');
}
```

## Community

Flare is an open-source project built for the Laravel community. We welcome contributions, feedback, and suggestions!

-   [GitHub Repository](https://github.com/alizharb/flare)
-   [Report an Issue](https://github.com/alizharb/flare/issues)
