<?php

declare(strict_types=1);

namespace AlizHarb\Flare;

use Livewire\Component;
use Livewire\LivewireManager;

/**
 * FlareManager handles the core functionality for displaying toast notifications.
 *
 * This class provides methods to trigger various types of toast notifications
 * with advanced features like action buttons, priority ordering, rate limiting,
 * and toast history tracking.
 */
final class FlareManager
{
    /**
     * Default position for toasts.
     */
    private string $position = 'bottom end';

    /**
     * Whether toasts are expanded by default.
     */
    private true $expanded = true;

    /**
     * Maximum number of visible toasts.
     */
    private int $maxVisible = 999;

    /**
     * Toast rate limiting tracker.
     *
     * @var array<int, int>
     */
    private array $rateLimitTracker = [];

    /**
     * Valid toast variants.
     */
    private const array VALID_VARIANTS = ['success', 'warning', 'danger', 'info'];

    /**
     * Valid toast positions.
     */
    private const array VALID_POSITIONS = [
        'top start',
        'top center',
        'top end',
        'bottom start',
        'bottom center',
        'bottom end',
    ];

    /**
     * Valid priority levels.
     */
    private const array VALID_PRIORITIES = ['low' => 0, 'normal' => 1, 'high' => 2, 'urgent' => 3];

    /**
     * Display a toast notification with full options.
     *
     * @param  string  $text  The main text content to display
     * @param  string|null  $heading  Optional heading text for the toast
     * @param  int  $duration  Duration in milliseconds (0 for persistent)
     * @param  string|null  $variant  Toast variant (success, warning, danger, info)
     * @param  string|null  $position  Toast position on screen
     * @param  array<string, mixed>  $options  Additional options (icon, actions, priority, group)
     */
    public function toast(
        string $text,
        ?string $heading = null,
        int $duration = 5000,
        ?string $variant = null,
        ?string $position = null,
        array $options = []
    ): void {
        // Check rate limiting
        if ($this->isRateLimited()) {
            return;
        }

        $params = [
            'duration' => $duration,
            'slots' => [],
            'dataset' => [],
        ];

        if ($text !== '') {
            $params['slots']['text'] = $text;
        }

        if ($heading !== null && $heading !== '') {
            $params['slots']['heading'] = $heading;
        }

        if ($variant !== null && in_array($variant, self::VALID_VARIANTS, true)) {
            $params['dataset']['variant'] = $variant;
        }

        if ($position !== null && $this->isValidPosition($position)) {
            $params['dataset']['position'] = $position;
        } else {
            $params['dataset']['position'] = $this->position;
        }

        // Add custom icon if provided
        if (isset($options['icon']) && config('flare.icons.enabled', true)) {
            $params['dataset']['icon'] = $options['icon'];
        }

        // Add action buttons if provided
        if (isset($options['actions']) && config('flare.actions.enabled', true)) {
            $maxActions = config('flare.actions.max_per_toast', 2);
            assert(is_int($maxActions));
            assert(is_array($options['actions']));
            $params['dataset']['actions'] = array_slice($options['actions'], 0, $maxActions);
        }

        // Add priority if provided
        if (isset($options['priority']) && config('flare.priority.enabled', true)) {
            assert(is_string($options['priority']) || is_int($options['priority']));
            $priority = $this->normalizePriority($options['priority']);
            $params['dataset']['priority'] = $priority;
        } else {
            $params['dataset']['priority'] = config('flare.priority.default', 1);
        }

        // Add group if provided
        if (isset($options['group'])) {
            $params['dataset']['group'] = $options['group'];
        }

        // Add sound if enabled
        if (isset($options['sound']) && config('flare.sound.enabled', false)) {
            $params['dataset']['sound'] = $options['sound'];
        }

        $params['dataset']['expanded'] = $this->expanded;
        $params['dataset']['maxVisible'] = $this->maxVisible;

        $this->dispatchToast($params);
        $this->trackRateLimit();
    }

    /**
     * Display a success toast notification.
     *
     * @param  string  $text  The main text content to display
     * @param  string|null  $heading  Optional heading text for the toast
     * @param  int  $duration  Duration in milliseconds (0 for persistent)
     * @param  string|null  $position  Toast position on screen
     * @param  array<string, mixed>  $options  Additional options
     */
    public function success(
        string $text,
        ?string $heading = null,
        int $duration = 5000,
        ?string $position = null,
        array $options = []
    ): void {
        $this->toast($text, $heading, $duration, 'success', $position, $options);
    }

    /**
     * Display a warning toast notification.
     *
     * @param  string  $text  The main text content to display
     * @param  string|null  $heading  Optional heading text for the toast
     * @param  int  $duration  Duration in milliseconds (0 for persistent)
     * @param  string|null  $position  Toast position on screen
     * @param  array<string, mixed>  $options  Additional options
     */
    public function warning(
        string $text,
        ?string $heading = null,
        int $duration = 5000,
        ?string $position = null,
        array $options = []
    ): void {
        $this->toast($text, $heading, $duration, 'warning', $position, $options);
    }

    /**
     * Display a danger/error toast notification.
     *
     * @param  string  $text  The main text content to display
     * @param  string|null  $heading  Optional heading text for the toast
     * @param  int  $duration  Duration in milliseconds (0 for persistent)
     * @param  string|null  $position  Toast position on screen
     * @param  array<string, mixed>  $options  Additional options
     */
    public function danger(
        string $text,
        ?string $heading = null,
        int $duration = 5000,
        ?string $position = null,
        array $options = []
    ): void {
        $this->toast($text, $heading, $duration, 'danger', $position, $options);
    }

    /**
     * Display an error toast notification (alias for danger).
     *
     * @param  string  $text  The main text content to display
     * @param  string|null  $heading  Optional heading text for the toast
     * @param  int  $duration  Duration in milliseconds (0 for persistent)
     * @param  string|null  $position  Toast position on screen
     * @param  array<string, mixed>  $options  Additional options
     */
    public function error(
        string $text,
        ?string $heading = null,
        int $duration = 5000,
        ?string $position = null,
        array $options = []
    ): void {
        $this->danger($text, $heading, $duration, $position, $options);
    }

    /**
     * Display an info toast notification.
     *
     * @param  string  $text  The main text content to display
     * @param  string|null  $heading  Optional heading text for the toast
     * @param  int  $duration  Duration in milliseconds (0 for persistent)
     * @param  string|null  $position  Toast position on screen
     * @param  array<string, mixed>  $options  Additional options
     */
    public function info(
        string $text,
        ?string $heading = null,
        int $duration = 5000,
        ?string $position = null,
        array $options = []
    ): void {
        $this->toast($text, $heading, $duration, 'info', $position, $options);
    }

    /**
     * Display a toast using a pre-defined template.
     *
     * @param  string  $template  Template name
     * @param  array<string, mixed>  $data  Data to pass to template
     */
    public function template(string $template, array $data = []): void
    {
        $templates = [
            'saved' => [
                'text' => $data['message'] ?? 'Changes saved successfully',
                'heading' => 'Saved',
                'variant' => 'success',
                'duration' => 3000,
            ],
            'deleted' => [
                'text' => $data['message'] ?? 'Item deleted successfully',
                'heading' => 'Deleted',
                'variant' => 'danger',
                'duration' => 3000,
            ],
            'error' => [
                'text' => $data['message'] ?? 'An error occurred',
                'heading' => 'Error',
                'variant' => 'danger',
                'duration' => 5000,
            ],
            'loading' => [
                'text' => $data['message'] ?? 'Processing...',
                'heading' => null,
                'variant' => 'info',
                'duration' => 0,
            ],
        ];

        if (! isset($templates[$template])) {
            return;
        }

        $config = array_merge($templates[$template], $data);

        $text = $config['text'];
        assert(is_string($text));

        $heading = $config['heading'] ?? null;
        assert(is_string($heading) || $heading === null);

        $duration = $config['duration'] ?? 5000;
        assert(is_int($duration));

        $variant = $config['variant'] ?? null;
        assert(is_string($variant) || $variant === null);

        $position = $config['position'] ?? null;
        assert(is_string($position) || $position === null);

        $options = $config['options'] ?? [];
        assert(is_array($options));
        /** @var array<string, mixed> $options */
        $this->toast($text, $heading, $duration, $variant, $position, $options);
    }

    /**
     * Generate the Flare JavaScript include tag.
     *
     * @return string The HTML script tag for including Flare JavaScript
     */
    public function scripts(): string
    {
        $path = config('flare.asset_path', '/vendor/flare/flare.js');
        assert(is_string($path));

        return sprintf(
            '<script src="%s" defer></script>',
            asset($path)
        );
    }

    /**
     * Generate the Flare CSS include tag.
     *
     * @return string The HTML link tag for including Flare CSS
     */
    public function styles(): string
    {
        $path = config('flare.css_path', '/vendor/flare/flare.css');
        assert(is_string($path));

        return sprintf(
            '<link rel="stylesheet" href="%s">',
            asset($path)
        );
    }

    /**
     * Validate if a position string is valid.
     *
     * @param  string  $position  The position to validate
     * @return bool True if the position is valid, false otherwise
     */
    private function isValidPosition(string $position): bool
    {
        return in_array($position, self::VALID_POSITIONS, true);
    }

    /**
     * Normalize priority value to integer.
     *
     * @param  string|int  $priority  Priority value
     * @return int Normalized priority (0-3)
     */
    private function normalizePriority(string|int $priority): int
    {
        if (is_int($priority)) {
            return max(0, min(3, $priority));
        }

        return self::VALID_PRIORITIES[strtolower($priority)] ?? 1;
    }

    /**
     * Check if rate limiting is active.
     *
     * @return bool True if rate limited, false otherwise
     */
    private function isRateLimited(): bool
    {
        if (! config('flare.rate_limit.enabled', true)) {
            return false;
        }

        $maxToasts = config('flare.rate_limit.max_toasts', 10);
        $timeWindow = config('flare.rate_limit.time_window', 60);
        assert(is_int($timeWindow));
        $now = time();
        $cutoff = $now - $timeWindow;

        // Clean old entries
        $this->rateLimitTracker = array_filter(
            $this->rateLimitTracker,
            fn ($timestamp) => $timestamp > $cutoff
        );

        return count($this->rateLimitTracker) >= $maxToasts;
    }

    /**
     * Track toast for rate limiting.
     */
    private function trackRateLimit(): void
    {
        if (config('flare.rate_limit.enabled', true)) {
            $this->rateLimitTracker[] = time();
        }
    }

    /**
     * Dispatch the toast event to Livewire components.
     *
     * @param  array<string, mixed>  $params  The toast parameters
     */
    private function dispatchToast(array $params): void
    {
        if (app()->bound('livewire')) {
            /** @var LivewireManager $livewire */
            $livewire = app('livewire');

            // @phpstan-ignore-next-line - method_exists checks are redundant due to PHPDoc types
            if ($livewire->isLivewireRequest() && method_exists($livewire, 'current')) {
                /** @var Component $component */
                $component = $livewire->current();

                // @phpstan-ignore-next-line - method_exists checks are redundant due to PHPDoc types
                if ($component && method_exists($component, 'dispatch')) {
                    $component->dispatch('flare-toast-show', ...$params);
                }
            }
        }
    }
}
