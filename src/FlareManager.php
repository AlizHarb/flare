<?php

declare(strict_types=1);

namespace AlizHarb\Flare;

/**
 * FlareManager handles the core functionality for displaying toast notifications.
 *
 * This class provides methods to trigger various types of toast notifications
 * and integrates seamlessly with Laravel Livewire components.
 */
final readonly class FlareManager
{
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
     * Display a toast notification.
     *
     * @param string      $text     The main text content to display
     * @param string|null $heading  Optional heading text for the toast
     * @param int         $duration Duration in milliseconds (0 for persistent)
     * @param string|null $variant  Toast variant (success, warning, danger, info)
     * @param string|null $position Toast position on screen
     */
    public function toast(
        string $text,
        ?string $heading = null,
        int $duration = 5000,
        ?string $variant = null,
        ?string $position = null
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

        if ($variant !== null && in_array($variant, self::VALID_VARIANTS, true)) {
            $params['dataset']['variant'] = $variant;
        }

        if ($position !== null && $this->isValidPosition($position)) {
            $params['dataset']['position'] = $position;
        }

        $this->dispatchToast($params);
    }

    /**
     * Display a success toast notification.
     *
     * @param string      $text     The main text content to display
     * @param string|null $heading  Optional heading text for the toast
     * @param int         $duration Duration in milliseconds (0 for persistent)
     * @param string|null $position Toast position on screen
     */
    public function success(
        string $text,
        ?string $heading = null,
        int $duration = 5000,
        ?string $position = null
    ): void {
        $this->toast($text, $heading, $duration, 'success', $position);
    }

    /**
     * Display a warning toast notification.
     *
     * @param string      $text     The main text content to display
     * @param string|null $heading  Optional heading text for the toast
     * @param int         $duration Duration in milliseconds (0 for persistent)
     * @param string|null $position Toast position on screen
     */
    public function warning(
        string $text,
        ?string $heading = null,
        int $duration = 5000,
        ?string $position = null
    ): void {
        $this->toast($text, $heading, $duration, 'warning', $position);
    }

    /**
     * Display a danger/error toast notification.
     *
     * @param string      $text     The main text content to display
     * @param string|null $heading  Optional heading text for the toast
     * @param int         $duration Duration in milliseconds (0 for persistent)
     * @param string|null $position Toast position on screen
     */
    public function danger(
        string $text,
        ?string $heading = null,
        int $duration = 5000,
        ?string $position = null
    ): void {
        $this->toast($text, $heading, $duration, 'danger', $position);
    }

    /**
     * Display an error toast notification (alias for danger).
     *
     * @param string      $text     The main text content to display
     * @param string|null $heading  Optional heading text for the toast
     * @param int         $duration Duration in milliseconds (0 for persistent)
     * @param string|null $position Toast position on screen
     */
    public function error(
        string $text,
        ?string $heading = null,
        int $duration = 5000,
        ?string $position = null
    ): void {
        $this->danger($text, $heading, $duration, $position);
    }

    /**
     * Display an info toast notification.
     *
     * @param string      $text     The main text content to display
     * @param string|null $heading  Optional heading text for the toast
     * @param int         $duration Duration in milliseconds (0 for persistent)
     * @param string|null $position Toast position on screen
     */
    public function info(
        string $text,
        ?string $heading = null,
        int $duration = 5000,
        ?string $position = null
    ): void {
        $this->toast($text, $heading, $duration, 'info', $position);
    }

    /**
     * Generate the Flare JavaScript include tag.
     *
     * @return string The HTML script tag for including Flare JavaScript
     */
    public function scripts(): string
    {
        $path = config('flare.asset_path', '/vendor/flare/flare.js');

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

        return sprintf(
            '<link rel="stylesheet" href="%s">',
            asset($path)
        );
    }

    /**
     * Validate if a position string is valid.
     *
     * @param string $position The position to validate
     *
     * @return bool True if the position is valid, false otherwise
     */
    private function isValidPosition(string $position): bool
    {
        return in_array($position, self::VALID_POSITIONS, true);
    }

    /**
     * Dispatch the toast event to Livewire components.
     *
     * @param array<string, mixed> $params The toast parameters
     */
    private function dispatchToast(array $params): void
    {
        if (app()->bound('livewire')) {
            $livewire = app('livewire');

            if ($livewire->isLivewireRequest() && method_exists($livewire, 'current')) {
                $component = $livewire->current();

                if ($component && method_exists($component, 'dispatch')) {
                    $component->dispatch('flare-toast-show', ...$params);
                }
            }
        }
    }
}
