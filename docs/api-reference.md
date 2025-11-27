# API Reference

This page documents the available methods on the `Flare` facade.

## Facade Methods

### `success()`

Shows a success notification (green).

```php
Flare::success(string $text, string|null $heading = null, int|null $duration = null)
```

| Parameter   | Type     | Description                  |
| :---------- | :------- | :--------------------------- |
| `$text`     | `string` | The main message to display. |
| `$heading`  | `string` | Optional bold title.         |
| `$duration` | `int`    | Duration in milliseconds.    |

### `error()`

Shows an error notification (red). Alias: `danger()`.

```php
Flare::error(string $text, string|null $heading = null, int|null $duration = null)
```

### `warning()`

Shows a warning notification (yellow/orange).

```php
Flare::warning(string $text, string|null $heading = null, int|null $duration = null)
```

### `info()`

Shows an info notification (blue).

```php
Flare::info(string $text, string|null $heading = null, int|null $duration = null)
```

### `toast()`

The generic method for showing a toast with full control.

```php
Flare::toast(string $text, array $options = [])
```

**Available Options:**

| Option     | Type     | Default  | Description                           |
| :--------- | :------- | :------- | :------------------------------------ |
| `heading`  | `string` | `null`   | Bold title text                       |
| `variant`  | `string` | `'info'` | `success`, `error`, `warning`, `info` |
| `theme`    | `string` | `config` | `modern`, `classic`, `vibrant`        |
| `duration` | `int`    | `5000`   | Time in ms. `0` for persistent.       |
| `position` | `string` | `config` | `top-right`, `bottom-center`, etc.    |
| `icon`     | `string` | `null`   | Custom SVG icon string                |
| `sound`    | `string` | `null`   | URL to sound file to play             |

## JavaScript API

Flare also exposes a global `window.Flare` object for client-side usage.

### `Flare.success(text, options)`

### `Flare.error(text, options)`

### `Flare.warning(text, options)`

### `Flare.info(text, options)`

### `Flare.toast(text, options)`

**Example:**

```javascript
Flare.success("Hello from JS!", {
    heading: "Welcome",
    duration: 3000,
});
```
