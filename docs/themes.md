# Themes

Flare provides 3 distinct, professionally designed themes. Each theme supports both light and dark modes.

## Available Themes

### Classic Theme - Minimal & Professional

Perfect for enterprise applications and admin dashboards.

**Features:**

- Solid backgrounds
- Single shadow layer
- No blur or gradients
- Fastest performance
- Clean, professional look

**Configuration:**

```php
// config/flare.php
'theme' => 'classic',
```

Or via environment:

```env
FLARE_THEME=classic
```

**Best For:**

- Enterprise applications
- Admin dashboards
- Professional tools
- Performance-critical apps

---

### Modern Theme - Balanced & Contemporary (Default)

Perfect for SaaS applications and general websites.

**Features:**

- Subtle transparency (98%)
- Light blur (4px)
- Gradient backgrounds
- 2 shadow layers
- Balanced aesthetics

**Configuration:**

```php
// config/flare.php
'theme' => 'modern', // Default
```

**Best For:**

- SaaS applications
- Web applications
- General websites
- Balanced design needs

---

### Vibrant Theme - Bold & Colorful

Perfect for marketing sites and consumer applications.

**Features:**

- Strong gradients
- Glowing colored shadows
- Moderate blur (8px)
- Eye-catching design
- Bold, saturated colors

**Configuration:**

```php
// config/flare.php
'theme' => 'vibrant',
```

Or via environment:

```env
FLARE_THEME=vibrant
```

**Best For:**

- Marketing websites
- Consumer applications
- Creative platforms
- Attention-grabbing notifications

## Theme Comparison

| Feature         | Classic    | Modern   | Vibrant         |
| --------------- | ---------- | -------- | --------------- |
| **Shadows**     | 1 layer    | 2 layers | 2 layers + glow |
| **Blur**        | None       | 4px      | 8px             |
| **Gradients**   | None       | Subtle   | Bold            |
| **Performance** | ⚡ Fastest | ⚡ Fast  | ⚡ Good         |
| **Best For**    | Enterprise | SaaS     | Marketing       |

## Light & Dark Modes

All themes automatically support both light and dark modes based on:

1. **System Preference**: `prefers-color-scheme: dark`
2. **Tailwind Dark Mode**: `.dark` class on HTML element

### Example

```html
<!-- Light mode (default) -->
<html>
  <!-- Toasts use light theme -->
</html>

<!-- Dark mode (Tailwind) -->
<html class="dark">
  <!-- Toasts automatically use dark theme -->
</html>
```

## Switching Themes

### Global Configuration

Set the theme once in your config file:

```php
// config/flare.php
return [
    'theme' => 'modern', // classic, modern, vibrant
];
```

### Environment-Based

Use different themes per environment:

```env
# .env.local (development)
FLARE_THEME=vibrant

# .env.production
FLARE_THEME=classic
```

## Theme Examples

### Classic Theme

```php
// Minimal, professional notification
Flare::success('Data saved successfully');
```

**Appearance:**

- Solid white background (light mode)
- Solid dark background (dark mode)
- Simple border
- Single shadow
- No blur

### Modern Theme

```php
// Balanced, contemporary notification
Flare::info('Your report is ready for download');
```

**Appearance:**

- Semi-transparent background
- Subtle gradient
- Light blur effect
- Layered shadows
- Modern feel

### Vibrant Theme

```php
// Bold, eye-catching notification
Flare::success('Welcome to our platform!');
```

**Appearance:**

- Strong gradient background
- Glowing colored shadows
- Moderate blur
- Bold colors
- Attention-grabbing

## Customization

While Flare provides 3 pre-designed themes, you can customize the CSS if needed:

```bash
# Publish views to customize
php artisan vendor:publish --tag=flare-views
```

Then modify the CSS in `resources/css/flare.css`.

## Next Steps

- [Configuration](configuration.md) - All config options
- [Positioning](positioning.md) - Toast placement
- [Examples](examples.md) - Real-world use cases
