{{-- Flare Toasts Component - Wrapper for Livewire component --}}
<livewire:flare-toasts
    :position="$position"
    :expanded="$expanded"
    :max-visible="$maxVisible"
>
    {{ $slot ?? '' }}
</livewire:flare-toasts>
