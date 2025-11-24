# Quick Start

Get started with Flare in 5 minutes.

## Basic Usage

### Method 1: Using the Facade

Perfect for controllers, services, and any PHP class:

```php
use AlizHarb\Flare\Facades\Flare;

class UserController extends Controller
{
    public function store(Request $request)
    {
        // Your logic...

        Flare::success('User created successfully!');

        return redirect()->route('users.index');
    }
}
```

### Method 2: Using the Livewire Trait

The easiest way in Livewire components:

```php
use Livewire\Component;
use AlizHarb\Flare\Concerns\WithFlare;

class CreatePost extends Component
{
    use WithFlare;

    public function save()
    {
        // Your logic...

        $this->flareSuccess('Post published!');
    }

    public function render()
    {
        return view('livewire.create-post');
    }
}
```

### Method 3: Using JavaScript

For client-side notifications:

```javascript
// Simple toast
Flare.success("Item added to cart!");

// With options
Flare.toast("Welcome back!", {
  heading: "Hello User",
  variant: "info",
  duration: 5000,
});
```

## Toast Variants

Flare provides 4 variants for different notification types:

```php
// Success (green) - Confirmations
Flare::success('Operation completed');

// Warning (yellow) - Cautionary messages
Flare::warning('Please review this');

// Danger (red) - Errors
Flare::danger('Failed to save');

// Info (blue) - Informational
Flare::info('New features available');
```

## With Headings

Add a heading to your toasts:

```php
Flare::success(
    text: 'Your profile has been updated',
    heading: 'Success'
);
```

## Custom Duration

Control how long toasts are visible:

```php
// Quick message (2 seconds)
Flare::success('Saved', duration: 2000);

// Longer message (10 seconds)
Flare::warning('Important notice', duration: 10000);

// Persistent (manual dismiss only)
Flare::danger('Critical error', duration: 0);
```

## Custom Position

Override the default position:

```php
Flare::success(
    text: 'Message',
    position: 'top center'
);
```

Available positions:

- `top start`, `top center`, `top end`
- `bottom start`, `bottom center`, `bottom end`

## Complete Example

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

        // Send email logic...

        $this->flareSuccess(
            text: "Thank you! We'll get back to you soon.",
            heading: 'Message Sent',
            duration: 7000,
            position: 'top center'
        );

        $this->reset();
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
```

## Next Steps

- [Configuration](configuration.md) - Customize Flare
- [Themes](themes.md) - Choose your visual style
- [API Reference](api-reference.md) - All available methods
- [Examples](examples.md) - Real-world scenarios
