<?php

declare(strict_types=1);

namespace AlizHarb\Flare\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * ToastGroup Blade component for displaying grouped toast notifications.
 *
 * This component displays toasts with grouping and stacking functionality,
 * allowing users to expand/collapse the toast stack.
 */
final class ToastGroup extends Component
{
    /**
     * The position where toasts will be displayed.
     */
    public string $position;

    /**
     * Whether the toast stack is expanded by default.
     */
    public bool $expanded;

    /**
     * Maximum number of visible toasts before stacking.
     */
    public int $maxVisible;

    /**
     * Create a new toast group component instance.
     *
     * @param string|null $position   The position for displaying toasts
     * @param bool|null   $expanded   Whether toasts should be expanded by default
     * @param int|null    $maxVisible Maximum number of visible toasts
     */
    public function __construct(
        ?string $position = null,
        ?bool $expanded = null,
        ?int $maxVisible = null
    ) {
        $this->position = $position ?? config('flare.position', 'bottom end');
        $this->expanded = $expanded ?? config('flare.stack_expanded', false);
        $this->maxVisible = max(1, $maxVisible ?? config('flare.max_visible', 3));
    }

    /**
     * Render the toast group component view.
     *
     * @return View The rendered toast group component view
     */
    public function render(): View
    {
        return view('flare::components.toast-group', [
            'position' => $this->position,
            'expanded' => $this->expanded,
            'maxVisible' => $this->maxVisible,
        ]);
    }
}
