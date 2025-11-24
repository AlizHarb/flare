# API Reference

Complete API reference for Flare toast notifications.

---

## Facade Methods

All methods are available through `AlizHarb\Flare\Facades\Flare`:

### `toast()`

Create a toast notification with full control.

```php
Flare::toast(
    string $text,
    ?string $heading = null,
    int $duration = 5000,
    ?string $variant = null,
    ?string $position = null
): void
```

**Parameters:**

-   `$text` - The main message text
-   `$heading` - Optional heading/title
-   `$duration` - Duration in milliseconds (0 = persistent)
-   `$variant` - Toast variant: `success`, `warning`, `danger`, `info`
-   `$position` - Position: `top start`, `top center`, `top end`, `bottom start`, `bottom center`, `bottom end`

**Example:**

```php
Flare::toast(
    text: 'Your report is ready',
    heading: 'Success',
    duration: 7000,
    variant: 'success',
    position: 'top center'
);
```

---

### `success()`

Create a success toast (green).

```php
Flare::success(
    string $text,
    ?string $heading = null,
    int $duration = 5000,
    ?string $position = null
): void
```

**Example:**

```php
Flare::success('Profile updated successfully!');
Flare::success('Saved', 'Success', 3000);
```

---

### `warning()`

Create a warning toast (yellow).

```php
Flare::warning(
    string $text,
    ?string $heading = null,
    int $duration = 5000,
    ?string $position = null
): void
```

**Example:**

```php
Flare::warning('Session will expire soon');
Flare::warning('Low disk space', 'Warning', 10000);
```

---

### `danger()`

Create a danger/error toast (red).

```php
Flare::danger(
    string $text,
    ?string $heading = null,
    int $duration = 5000,
    ?string $position = null
): void
```

**Example:**

```php
Flare::danger('Failed to save changes');
Flare::danger('Connection lost', 'Error', 0); // Persistent
```

---

### `error()`

Alias for `danger()`.

```php
Flare::error(
    string $text,
    ?string $heading = null,
    int $duration = 5000,
    ?string $position = null
): void
```

---

### `info()`

Create an info toast (blue).

```php
Flare::info(
    string $text,
    ?string $heading = null,
    int $duration = 5000,
    ?string $position = null
): void
```

**Example:**

```php
Flare::info('New features available!');
Flare::info('Update ready', 'Info', 5000);
```

---

## Livewire Trait Methods

All methods are available when using `AlizHarb\Flare\Concerns\WithFlare`:

### `flareToast()`

```php
$this->flareToast(
    string $text,
    ?string $heading = null,
    int $duration = 5000,
    ?string $variant = null,
    ?string $position = null
): void
```

### `flareSuccess()`

```php
$this->flareSuccess(
    string $text,
    ?string $heading = null,
    int $duration = 5000,
    ?string $position = null
): void
```

### `flareWarning()`

```php
$this->flareWarning(
    string $text,
    ?string $heading = null,
    int $duration = 5000,
    ?string $position = null
): void
```

### `flareDanger()`

```php
$this->flareDanger(
    string $text,
    ?string $heading = null,
    int $duration = 5000,
    ?string $position = null
): void
```

### `flareError()`

```php
$this->flareError(
    string $text,
    ?string $heading = null,
    int $duration = 5000,
    ?string $position = null
): void
```

### `flareInfo()`

```php
$this->flareInfo(
    string $text,
    ?string $heading = null,
    int $duration = 5000,
    ?string $position = null
): void
```

**Example:**

```php
use Livewire\Component;
use AlizHarb\Flare\Concerns\WithFlare;

class MyComponent extends Component
{
    use WithFlare;

    public function save()
    {
        // Your logic...

        $this->flareSuccess('Saved successfully!');
    }
}
```

---

## JavaScript API

Available globally as `window.Flare`:

### `Flare.toast()`

```javascript
Flare.toast(text, options);
```

**Parameters:**

-   `text` (string) - The message text
-   `options` (object) - Optional configuration
    -   `heading` (string) - Toast heading
    -   `variant` (string) - `success`, `warning`, `danger`, `info`
    -   `duration` (number) - Duration in milliseconds
    -   `position` (string) - Toast position

**Example:**

```javascript
Flare.toast("Welcome back!", {
    heading: "Hello User",
    variant: "info",
    duration: 5000,
    position: "top center",
});
```

### `Flare.success()`

```javascript
Flare.success(text, options);
```

**Example:**

```javascript
Flare.success("Item added to cart!");
```

### `Flare.warning()`

```javascript
Flare.warning(text, options);
```

### `Flare.danger()`

```javascript
Flare.danger(text, options);
```

### `Flare.error()`

```javascript
Flare.error(text, options);
```

### `Flare.info()`

```javascript
Flare.info(text, options);
```

---

## Blade Directives

### `@flareStyles`

Include Flare CSS in your layout's `<head>`:

```blade
<head>
    @flareStyles
</head>
```

### `@flareScripts`

Include Flare JavaScript before closing `</body>`:

```blade
<body>
    @flareScripts
</body>
```

---

## Blade Components

### `<flare::toasts />`

Main toast container component:

```blade
<!-- Default -->
<flare::toasts />

<!-- With custom position -->
<flare::toasts position="top center" />

<!-- With stacking control -->
<flare::toasts :expanded="false" />

<!-- All options -->
<flare::toasts
    position="bottom end"
    :expanded="false"
/>
```

**Props:**

-   `position` (string) - Toast position
-   `expanded` (boolean) - Start expanded (true) or collapsed (false)

---

## Configuration Options

All configuration options from `config/flare.php`:

```php
return [
    'theme' => 'modern',              // classic, modern, vibrant
    'position' => 'bottom end',       // Toast position
    'duration' => 5000,               // Default duration (ms)
    'max_visible' => 3,               // Max toasts shown
    'enable_stacking' => true,        // Enable stacking
    'stack_expanded' => false,        // Start expanded
    'icons' => ['enabled' => true],   // Show icons
    'actions' => ['enabled' => true], // Action buttons
    'priority' => ['enabled' => true],// Priority system
    'rate_limit' => [                 // Rate limiting
        'enabled' => true,
        'max_toasts' => 10,
        'time_window' => 60,
    ],
    'progress_bar' => [               // Progress bar
        'enabled' => true,
        'position' => 'bottom',
    ],
];
```

---

## TypeScript Definitions

Flare includes TypeScript definitions in `resources/js/flare.d.ts`:

```typescript
interface FlareOptions {
    heading?: string;
    variant?: "success" | "warning" | "danger" | "info";
    duration?: number;
    position?: string;
}

interface Flare {
    toast(text: string, options?: FlareOptions): void;
    success(text: string, options?: FlareOptions): void;
    warning(text: string, options?: FlareOptions): void;
    danger(text: string, options?: FlareOptions): void;
    error(text: string, options?: FlareOptions): void;
    info(text: string, options?: FlareOptions): void;
}

declare global {
    interface Window {
        Flare: Flare;
    }
}
```

---

## Constants

### Variants

-   `success` - Green toast for successful operations
-   `warning` - Yellow toast for warnings
-   `danger` - Red toast for errors/critical alerts
-   `info` - Blue toast for informational messages

### Positions

-   `top start` - Top left
-   `top center` - Top center
-   `top end` - Top right
-   `bottom start` - Bottom left
-   `bottom center` - Bottom center
-   `bottom end` - Bottom right (default)

### Themes

-   `classic` - Minimal, professional
-   `modern` - Balanced, contemporary (default)
-   `vibrant` - Bold, colorful

---

## Events

Flare dispatches Livewire events:

### `flare-toast-show`

Triggered when showing a toast:

```javascript
window.addEventListener("flare-toast-show", (event) => {
    console.log("Toast shown:", event.detail);
});
```

---

## Return Values

All Flare methods return `void`. They dispatch events but do not return values.

---

## See Also

-   [Quick Start](quick-start.md) - Get started quickly
-   [Examples](../EXAMPLES.md) - Real-world examples
-   [Configuration](configuration.md) - All config options
