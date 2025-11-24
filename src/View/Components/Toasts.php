<?php

declare(strict_types=1);

namespace AlizHarb\Flare\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * Toasts Blade component - wrapper for the Livewire component.
 *
 * This component provides a convenient Blade syntax (<flare::toasts />) for including
 * the Flare toasts Livewire component.
 */
final class Toasts extends Component
{
    /**
     * Create a new component instance.
     *
     * @param  string|null  $position  Toast position
     * @param  bool|null  $expanded  Whether toasts are expanded by default
     * @param  int|null  $maxVisible  Maximum visible toasts
     */
    public function __construct(
        public ?string $position = null,
        public ?bool $expanded = null,
        public ?int $maxVisible = null,
    ) {
        // Defaults are handled by the Livewire component or config
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('flare::components.toasts');
    }
}
