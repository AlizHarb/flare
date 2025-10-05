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
    public string $position;

    /**
     * Whether toasts should be expanded by default.
     */
    public bool $expanded;

    /**
     * Initialize the component with position and expansion settings.
     *
     * @param string|null $position The position for displaying toasts
     * @param bool|null   $expanded Whether toasts should be expanded
     */
    public function mount(?string $position = null, ?bool $expanded = null): void
    {
        $this->position = $position ?? config('flare.position', 'bottom end');
        $this->expanded = $expanded ?? config('flare.stack_expanded', true);
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
