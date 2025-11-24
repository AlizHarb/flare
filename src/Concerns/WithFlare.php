<?php

declare(strict_types=1);

namespace AlizHarb\Flare\Concerns;

/**
 * Trait for Livewire components to easily dispatch Flare toast notifications.
 *
 * This trait provides convenient methods to trigger toast notifications from within
 * Livewire components with advanced features like action buttons, priority ordering,
 * and custom icons.
 *
 * @example
 * ```php
 * use Livewire\Component;
 * use AlizHarb\Flare\Concerns\WithFlare;
 *
 * class MyComponent extends Component
 * {
 *     use WithFlare;
 *
 *     public function save(): void
 *     {
 *         // Your save logic
 *         $this->flareSuccess('Record saved successfully!');
 *     }
 * }
 * ```
 *
 * @phpstan-ignore-next-line trait.unused
 */
trait WithFlare
{
    /**
     * Display a toast notification with full options.
     *
     * @param  string  $text  The main text content of the toast
     * @param  string|null  $heading  Optional heading text
     * @param  int  $duration  Duration in milliseconds (0 for persistent)
     * @param  string|null  $variant  Toast variant (success, warning, danger, info)
     * @param  string|null  $position  Toast position (e.g., 'top center', 'bottom end')
     * @param  array<string, mixed>  $options  Additional options (icon, actions, priority, group)
     */
    protected function flareToast(
        string $text,
        ?string $heading = null,
        int $duration = 5000,
        ?string $variant = null,
        ?string $position = null,
        array $options = []
    ): void {
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

        if ($variant !== null && in_array($variant, ['success', 'warning', 'danger', 'info'], true)) {
            $params['dataset']['variant'] = $variant;
        }

        if ($position !== null && $this->isValidFlarePosition($position)) {
            $params['dataset']['position'] = $position;
        }

        // Add custom icon if provided
        if (isset($options['icon'])) {
            $params['dataset']['icon'] = $options['icon'];
        }

        // Add action buttons if provided
        if (isset($options['actions'])) {
            $params['dataset']['actions'] = $options['actions'];
        }

        // Add priority if provided
        if (isset($options['priority'])) {
            $params['dataset']['priority'] = $options['priority'];
        }

        // Add group if provided
        if (isset($options['group'])) {
            $params['dataset']['group'] = $options['group'];
        }

        $this->dispatch('flare-toast-show', ...$params);
    }

    /**
     * Display a success toast notification.
     *
     * @param  string  $text  The main text content of the toast
     * @param  string|null  $heading  Optional heading text
     * @param  int  $duration  Duration in milliseconds (0 for persistent)
     * @param  string|null  $position  Toast position
     * @param  array<string, mixed>  $options  Additional options
     */
    protected function flareSuccess(
        string $text,
        ?string $heading = null,
        int $duration = 5000,
        ?string $position = null,
        array $options = []
    ): void {
        $this->flareToast($text, $heading, $duration, 'success', $position, $options);
    }

    /**
     * Display a warning toast notification.
     *
     * @param  string  $text  The main text content of the toast
     * @param  string|null  $heading  Optional heading text
     * @param  int  $duration  Duration in milliseconds (0 for persistent)
     * @param  string|null  $position  Toast position
     * @param  array<string, mixed>  $options  Additional options
     */
    protected function flareWarning(
        string $text,
        ?string $heading = null,
        int $duration = 5000,
        ?string $position = null,
        array $options = []
    ): void {
        $this->flareToast($text, $heading, $duration, 'warning', $position, $options);
    }

    /**
     * Display a danger/error toast notification.
     *
     * @param  string  $text  The main text content of the toast
     * @param  string|null  $heading  Optional heading text
     * @param  int  $duration  Duration in milliseconds (0 for persistent)
     * @param  string|null  $position  Toast position
     * @param  array<string, mixed>  $options  Additional options
     */
    protected function flareDanger(
        string $text,
        ?string $heading = null,
        int $duration = 5000,
        ?string $position = null,
        array $options = []
    ): void {
        $this->flareToast($text, $heading, $duration, 'danger', $position, $options);
    }

    /**
     * Display an error toast notification (alias for flareDanger).
     *
     * @param  string  $text  The main text content of the toast
     * @param  string|null  $heading  Optional heading text
     * @param  int  $duration  Duration in milliseconds (0 for persistent)
     * @param  string|null  $position  Toast position
     * @param  array<string, mixed>  $options  Additional options
     */
    protected function flareError(
        string $text,
        ?string $heading = null,
        int $duration = 5000,
        ?string $position = null,
        array $options = []
    ): void {
        $this->flareDanger($text, $heading, $duration, $position, $options);
    }

    /**
     * Display an info toast notification.
     *
     * @param  string  $text  The main text content of the toast
     * @param  string|null  $heading  Optional heading text
     * @param  int  $duration  Duration in milliseconds (0 for persistent)
     * @param  string|null  $position  Toast position
     * @param  array<string, mixed>  $options  Additional options
     */
    protected function flareInfo(
        string $text,
        ?string $heading = null,
        int $duration = 5000,
        ?string $position = null,
        array $options = []
    ): void {
        $this->flareToast($text, $heading, $duration, 'info', $position, $options);
    }

    /**
     * Display a toast using a pre-defined template.
     *
     * @param  string  $template  Template name
     * @param  array<string, mixed>  $data  Data to pass to template
     */
    protected function flareTemplate(string $template, array $data = []): void
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

        $this->flareToast(
            $config['text'],
            $config['heading'] ?? null,
            $config['duration'] ?? 5000,
            $config['variant'] ?? null,
            $config['position'] ?? null,
            $config['options'] ?? []
        );
    }

    /**
     * Validate if the position string is a valid Flare position.
     *
     * @param  string  $position  The position to validate
     * @return bool True if valid, false otherwise
     */
    private function isValidFlarePosition(string $position): bool
    {
        return in_array($position, [
            'top start',
            'top center',
            'top end',
            'bottom start',
            'bottom center',
            'bottom end',
        ], true);
    }
}
