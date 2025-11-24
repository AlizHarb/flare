# Flare Examples

Complete examples demonstrating all features of Flare toast notifications.

---

## Table of Contents

- [Basic Usage](#basic-usage)
- [Theme Examples](#theme-examples)
- [Position Examples](#position-examples)
- [Stacking Examples](#stacking-examples)
- [Advanced Features](#advanced-features)
- [Real-World Scenarios](#real-world-scenarios)

---

## Basic Usage

### Simple Toast Notifications

```php
use AlizHarb\Flare\Facades\Flare;

// Success toast
Flare::success('Operation completed successfully!');

// Warning toast
Flare::warning('Please review your settings');

// Danger/Error toast
Flare::danger('Failed to save changes');
Flare::error('An error occurred'); // Alias

// Info toast
Flare::info('New features are available');
```

### With Headings

```php
// Toast with heading
Flare::success(
    text: 'Your profile has been updated',
    heading: 'Success'
);

// Custom duration
Flare::warning(
    text: 'Session will expire soon',
    heading: 'Warning',
    duration: 10000 // 10 seconds
);
```

### Persistent Toasts

```php
// Toast that requires manual dismissal
Flare::danger(
    text: 'Critical error - please contact support',
    heading: 'Error',
    duration: 0 // Never auto-dismiss
);
```

---

## Theme Examples

### Classic Theme (Minimal & Fast)

```env
# .env
FLARE_THEME=classic
```

```php
// Perfect for enterprise applications
Flare::success('Data saved successfully');
```

**Features:**

- Solid backgrounds
- Single shadow layer
- No blur or gradients
- Fastest performance

### Modern Theme (Balanced - Default)

```env
# .env
FLARE_THEME=modern
```

```php
// Best for SaaS applications
Flare::info('Your report is ready for download');
```

**Features:**

- Subtle transparency (98%)
- Light blur (4px)
- Gradient backgrounds
- 2 shadow layers

### Vibrant Theme (Bold & Colorful)

```env
# .env
FLARE_THEME=vibrant
```

```php
// Perfect for marketing sites
Flare::success('Welcome to our platform!');
```

**Features:**

- Strong gradients
- Glowing colored shadows
- Moderate blur (8px)
- Eye-catching design

---

## Position Examples

### All 6 Positions

```php
// Top positions
Flare::success('Top Start', position: 'top start');
Flare::success('Top Center', position: 'top center');
Flare::success('Top End', position: 'top end');

// Bottom positions
Flare::success('Bottom Start', position: 'bottom start');
Flare::success('Bottom Center', position: 'bottom center');
Flare::success('Bottom End', position: 'bottom end'); // Default
```

### Global Position Configuration

```php
// config/flare.php
return [
    'position' => 'top center', // All toasts use this by default
];
```

### Per-Component Position

```blade
{{-- Top center toasts --}}
<flare::toasts position="top center" />

{{-- Bottom start toasts --}}
<flare::toasts position="bottom start" />
```

---

## Stacking Examples

### Enable Stacking

```php
// config/flare.php
return [
    'enable_stacking' => true,  // Enable stacking effect
    'stack_expanded' => false,  // Start collapsed
    'max_visible' => 3,         // Show max 3 toasts
];
```

### Disable Stacking (Simple List)

```php
// config/flare.php
return [
    'enable_stacking' => false, // Simple vertical list
];
```

### Component-Level Control

```blade
{{-- Stacking enabled, starts collapsed --}}
<flare::toasts :expanded="false" />

{{-- Stacking enabled, starts expanded --}}
<flare::toasts :expanded="true" />
```

---

## Advanced Features

### Livewire Integration

```php
use Livewire\Component;
use AlizHarb\Flare\Concerns\WithFlare;

class UserProfile extends Component
{
    use WithFlare;

    public $name;
    public $email;

    public function save()
    {
        $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
        ]);

        // Save logic...

        $this->flareSuccess(
            text: 'Profile updated successfully',
            heading: 'Success',
            duration: 5000
        );
    }

    public function delete()
    {
        $this->flareDanger(
            text: 'This action cannot be undone',
            heading: 'Warning',
            duration: 0 // Persistent
        );
    }

    public function render()
    {
        return view('livewire.user-profile');
    }
}
```

### JavaScript API

```javascript
// Simple notifications
Flare.success("Item added to cart!");
Flare.warning("Stock is low");
Flare.error("Payment failed");
Flare.info("New message received");

// With options
Flare.toast("Welcome back!", {
  heading: "Hello User",
  variant: "info",
  duration: 5000,
  position: "top center",
});

// Persistent toast
Flare.toast("Please review this", {
  variant: "warning",
  duration: 0, // Manual dismiss only
});
```

### Multiple Toasts

```php
// Queue multiple toasts
foreach ($users as $user) {
    Flare::success("Email sent to {$user->name}");
}

// They will appear progressively based on max_visible setting
```

---

## Real-World Scenarios

### Form Validation

```php
use Livewire\Component;
use AlizHarb\Flare\Concerns\WithFlare;

class ContactForm extends Component
{
    use WithFlare;

    public $name;
    public $email;
    public $message;

    public function submit()
    {
        $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'message' => 'required|min:10',
        ]);

        // Send email...

        $this->flareSuccess(
            text: "Thank you! We'll get back to you soon.",
            heading: 'Message Sent',
            duration: 7000,
            position: 'top center'
        );

        $this->reset();
    }

    public function updated($field)
    {
        try {
            $this->validateOnly($field);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $error = $e->validator->errors()->first($field);
            $this->flareWarning($error, 'Validation Error', 4000);
        }
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
```

### CRUD Operations

```php
class PostController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        Post::create($validated);

        Flare::success(
            text: 'Your post has been published',
            heading: 'Published',
            duration: 5000
        );

        return redirect()->route('posts.index');
    }

    public function update(Request $request, Post $post)
    {
        $post->update($request->validated());

        Flare::success('Post updated successfully');

        return back();
    }

    public function destroy(Post $post)
    {
        $post->delete();

        Flare::danger(
            text: 'Post has been permanently deleted',
            heading: 'Deleted',
            duration: 4000
        );

        return redirect()->route('posts.index');
    }
}
```

### File Upload Progress

```php
use Livewire\Component;
use Livewire\WithFileUploads;
use AlizHarb\Flare\Concerns\WithFlare;

class FileUploader extends Component
{
    use WithFileUploads, WithFlare;

    public $file;

    public function save()
    {
        $this->validate([
            'file' => 'required|file|max:10240', // 10MB
        ]);

        $this->flareInfo(
            text: 'Uploading file...',
            heading: 'Processing',
            duration: 0
        );

        $path = $this->file->store('uploads');

        $this->flareSuccess(
            text: 'File uploaded successfully',
            heading: 'Complete',
            duration: 5000
        );

        $this->reset('file');
    }

    public function render()
    {
        return view('livewire.file-uploader');
    }
}
```

### Batch Operations

```php
class BatchController extends Controller
{
    public function processUsers(Request $request)
    {
        $userIds = $request->input('user_ids');
        $processed = 0;

        foreach ($userIds as $userId) {
            try {
                $user = User::findOrFail($userId);
                // Process user...
                $processed++;
            } catch (\Exception $e) {
                Flare::warning("Failed to process user #{$userId}");
            }
        }

        if ($processed === count($userIds)) {
            Flare::success(
                text: "All {$processed} users processed successfully",
                heading: 'Batch Complete'
            );
        } else {
            Flare::warning(
                text: "{$processed} of " . count($userIds) . " users processed",
                heading: 'Partial Success'
            );
        }

        return back();
    }
}
```

### Session Expiry Warning

```javascript
// Warn user before session expires
let sessionTimeout = 300000; // 5 minutes
let warningTime = 240000; // 4 minutes

setTimeout(() => {
  Flare.warning("Your session will expire in 1 minute", {
    heading: "Session Expiring",
    duration: 60000, // Show for 1 minute
    position: "top center",
  });
}, warningTime);
```

### Real-time Notifications

```php
// In your Livewire component
use Livewire\Attributes\On;

class NotificationListener extends Component
{
    use WithFlare;

    #[On('echo:notifications,NewNotification')]
    public function handleNotification($data)
    {
        $this->flareInfo(
            text: $data['message'],
            heading: 'New Notification',
            duration: 7000
        );
    }

    public function render()
    {
        return view('livewire.notification-listener');
    }
}
```

---

## Configuration Examples

### Complete Configuration

```php
// config/flare.php
return [
    // Visual theme
    'theme' => 'modern', // classic, modern, vibrant

    // Default position
    'position' => 'bottom end',

    // Default duration (ms)
    'duration' => 5000,

    // Maximum visible toasts
    'max_visible' => 3,

    // Stacking behavior
    'enable_stacking' => true,
    'stack_expanded' => false,

    // Icons
    'icons' => [
        'enabled' => true,
    ],

    // Actions
    'actions' => [
        'enabled' => true,
        'max_per_toast' => 2,
    ],

    // Priority
    'priority' => [
        'enabled' => true,
        'default' => 1,
    ],

    // Rate limiting
    'rate_limit' => [
        'enabled' => true,
        'max_toasts' => 10,
        'time_window' => 60,
    ],

    // Progress bar
    'progress_bar' => [
        'enabled' => true,
        'position' => 'bottom',
    ],

    // Asset paths
    'asset_path' => 'vendor/alizharb/flare/flare.js',
    'css_path' => 'vendor/alizharb/flare/flare.css',
];
```

### Environment Variables

```env
# Theme
FLARE_THEME=modern

# Position
FLARE_POSITION="bottom end"

# Duration
FLARE_DURATION=5000

# Stacking
FLARE_ENABLE_STACKING=true
FLARE_STACK_EXPANDED=false
FLARE_MAX_VISIBLE=3

# Features
FLARE_ICONS_ENABLED=true
FLARE_ACTIONS_ENABLED=true
FLARE_PRIORITY_ENABLED=true
FLARE_RATE_LIMIT_ENABLED=true
FLARE_PROGRESS_BAR_ENABLED=true
```

---

## Keyboard Shortcuts

All keyboard shortcuts work automatically:

| Shortcut      | Action                    |
| ------------- | ------------------------- |
| `Esc`         | Dismiss most recent toast |
| `Shift + Esc` | Dismiss all toasts        |
| `Alt + D`     | Dismiss all toasts (alt)  |

---

## Tips & Best Practices

### 1. Choose the Right Variant

```php
// ✅ Good - Clear intent
Flare::success('Payment processed');
Flare::warning('Low disk space');
Flare::danger('Failed to connect to database');
Flare::info('New version available');

// ❌ Avoid - Confusing
Flare::success('Error occurred'); // Use danger instead
Flare::danger('Task completed'); // Use success instead
```

### 2. Use Appropriate Durations

```php
// ✅ Good
Flare::success('Saved', duration: 3000);        // Quick confirmation
Flare::warning('Review this', duration: 7000);  // Important message
Flare::danger('Critical', duration: 0);         // Requires attention

// ❌ Avoid
Flare::success('Saved', duration: 30000);       // Too long
Flare::danger('Error', duration: 1000);         // Too short
```

### 3. Position Consistency

```php
// ✅ Good - Consistent positioning
// Set global position in config
'position' => 'bottom end',

// ❌ Avoid - Random positions
Flare::success('Message 1', position: 'top start');
Flare::success('Message 2', position: 'bottom end');
Flare::success('Message 3', position: 'top center');
```

### 4. Theme Selection

```php
// Classic - Best for:
// - Enterprise applications
// - Admin dashboards
// - Performance-critical apps

// Modern - Best for:
// - SaaS applications
// - General websites
// - Balanced aesthetics

// Vibrant - Best for:
// - Marketing sites
// - Consumer apps
// - Eye-catching notifications
```

---

## Troubleshooting

### Toasts Not Appearing

```blade
{{-- Make sure you have all required directives --}}
<!DOCTYPE html>
<html>
<head>
    @flareStyles {{-- Required --}}
</head>
<body>
    <flare::toasts /> {{-- Required --}}

    @flareScripts {{-- Required --}}
</body>
</html>
```

### Assets Not Loading

```bash
# Publish assets
php artisan vendor:publish --tag=flare-assets

# Clear cache
php artisan optimize:clear
```

### Positioning Issues

```php
// Use standard position names with spaces
'position' => 'bottom end',  // ✅ Correct
'position' => 'bottom-end',  // ❌ Wrong
```

---

## Summary

Flare provides a complete toast notification system with:

- ✅ 3 distinct themes (Classic, Modern, Vibrant)
- ✅ 6 positioning options
- ✅ Configurable stacking behavior
- ✅ Light/Dark mode support
- ✅ RTL/LTR support
- ✅ Livewire integration
- ✅ JavaScript API
- ✅ Keyboard shortcuts
- ✅ Full customization

For more information, see the [README](README.md) and [CHANGELOG](CHANGELOG.md).
