<?php

declare(strict_types=1);

namespace AlizHarb\Flare\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

/**
 * Toasts Livewire component for displaying toast notifications.
 *
 * This component manages the display of toast notifications and handles
 * positioning and expansion state based on configuration.
 */
final class Toasts extends Component
{
    /**
     * The position where toasts will be displayed.
     */
    public string $position = 'bottom end';

    /**
     * Whether toasts should be expanded by default.
     */
    public bool $expanded = true;

    /**
     * The maximum number of toasts to display.
     */
    public int $maxVisible = 999;

    /**
     * Create a new toast component instance.
     *
     * @param  string|null  $position  The position for displaying toasts
     */
    public function __construct(
        ?string $position = null
    ) {
        $pos = $position ?? config('flare.position', 'bottom end');
        assert(is_string($pos));
        $this->position = $pos;
        $this->expanded = (bool) config('flare.stack_expanded', false);
        
        $maxVisible = config('flare.max_visible', 3);
        assert(is_int($maxVisible));
        $this->maxVisible = $maxVisible;
    }

    /**
     * Render the toast component view.
     *
     * @return View The rendered toast view
     */
    public function render(): View
    {
        return view('flare::livewire.toasts');
    }
}
