<?php

declare(strict_types=1);

namespace AlizHarb\Flare\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * Toast Blade component for displaying individual toast notifications.
 *
 * This component displays all toasts without grouping or stacking.
 * Toasts are always expanded and visible.
 */
final class Toast extends Component
{
    /**
     * The position where toasts will be displayed.
     */
    public string $position;

    /**
     * Whether toasts are expanded (always true for simple toast).
     */
    public bool $expanded;

    /**
     * Maximum number of visible toasts (999 to show all).
     */
    public int $maxVisible;

    /**
     * Create a new toast component instance.
     *
     * @param string|null $position   The position for displaying toasts
     * @param bool|null   $expanded   Whether toasts should be expanded (ignored, always true)
     * @param int|null    $maxVisible Maximum visible toasts (ignored, always shows all)
     */
    public function __construct(
        ?string $position = null,
        ?bool $expanded = null,
        ?int $maxVisible = null
    ) {
        $this->position = $position ?? config('flare.position', 'bottom end');
        $this->expanded = true;
        $this->maxVisible = 999;
    }

    /**
     * Render the toast component view.
     *
     * @return View The rendered toast component view
     */
    public function render(): View
    {
        return view('flare::components.toast', [
            'position' => $this->position,
            'expanded' => $this->expanded,
            'maxVisible' => $this->maxVisible,
        ]);
    }
}
