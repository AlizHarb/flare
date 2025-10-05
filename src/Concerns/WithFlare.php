<?php

declare(strict_types=1);

namespace AlizHarb\Flare\Concerns;

/**
 * Trait for Livewire components to easily dispatch Flare toast notifications.
 *
 * This trait provides convenient methods to trigger toast notifications from within
 * Livewire components, eliminating the need to manually dispatch events.
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
 */
trait WithFlare
{
    /**
     * Display a toast notification.
     *
     * @param string      $text     The main text content of the toast
     * @param string|null $heading  Optional heading text
     * @param int         $duration Duration in milliseconds (0 for persistent)
     * @param string|null $variant  Toast variant (success, warning, danger, info)
     * @param string|null $position Toast position (e.g., 'top center', 'bottom end')
     */
    protected function flareToast(
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

        if ($variant !== null && in_array($variant, ['success', 'warning', 'danger', 'info'], true)) {
            $params['dataset']['variant'] = $variant;
        }

        if ($position !== null && $this->isValidFlarePosition($position)) {
            $params['dataset']['position'] = $position;
        }

        $this->dispatch('flare-toast-show', ...$params);
    }

    /**
     * Display a success toast notification.
     *
     * @param string      $text     The main text content of the toast
     * @param string|null $heading  Optional heading text
     * @param int         $duration Duration in milliseconds (0 for persistent)
     * @param string|null $position Toast position
     */
    protected function flareSuccess(
        string $text,
        ?string $heading = null,
        int $duration = 5000,
        ?string $position = null
    ): void {
        $this->flareToast($text, $heading, $duration, 'success', $position);
    }

    /**
     * Display a warning toast notification.
     *
     * @param string      $text     The main text content of the toast
     * @param string|null $heading  Optional heading text
     * @param int         $duration Duration in milliseconds (0 for persistent)
     * @param string|null $position Toast position
     */
    protected function flareWarning(
        string $text,
        ?string $heading = null,
        int $duration = 5000,
        ?string $position = null
    ): void {
        $this->flareToast($text, $heading, $duration, 'warning', $position);
    }

    /**
     * Display a danger/error toast notification.
     *
     * @param string      $text     The main text content of the toast
     * @param string|null $heading  Optional heading text
     * @param int         $duration Duration in milliseconds (0 for persistent)
     * @param string|null $position Toast position
     */
    protected function flareDanger(
        string $text,
        ?string $heading = null,
        int $duration = 5000,
        ?string $position = null
    ): void {
        $this->flareToast($text, $heading, $duration, 'danger', $position);
    }

    /**
     * Display an error toast notification (alias for flareDanger).
     *
     * @param string      $text     The main text content of the toast
     * @param string|null $heading  Optional heading text
     * @param int         $duration Duration in milliseconds (0 for persistent)
     * @param string|null $position Toast position
     */
    protected function flareError(
        string $text,
        ?string $heading = null,
        int $duration = 5000,
        ?string $position = null
    ): void {
        $this->flareDanger($text, $heading, $duration, $position);
    }

    /**
     * Display an info toast notification.
     *
     * @param string      $text     The main text content of the toast
     * @param string|null $heading  Optional heading text
     * @param int         $duration Duration in milliseconds (0 for persistent)
     * @param string|null $position Toast position
     */
    protected function flareInfo(
        string $text,
        ?string $heading = null,
        int $duration = 5000,
        ?string $position = null
    ): void {
        $this->flareToast($text, $heading, $duration, 'info', $position);
    }

    /**
     * Validate if the position string is a valid Flare position.
     *
     * @param string $position The position to validate
     *
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
