<div
    x-data="flareToasts({
        position: '{{ $position }}',
        expanded: {{ $expanded ? 'true' : 'false' }},
        maxVisible: {{ config('flare.max_visible', 3) }}
    })"
    x-on:flare-toast-show.window="showToast($event.detail)"
    wire:ignore
    class="flare-toast-container fixed z-50 pointer-events-none"
    :class="{
        'bottom-0 right-0 mb-6 mr-6': position === 'bottom end',
        'bottom-0 left-1/2 -translate-x-1/2 mb-6': position === 'bottom center',
        'bottom-0 left-0 mb-6 ml-6': position === 'bottom start',
        'top-0 right-0 mt-6 mr-6': position === 'top end',
        'top-0 left-1/2 -translate-x-1/2 mt-6': position === 'top center',
        'top-0 left-0 mt-6 ml-6': position === 'top start',
    }"
>
    <div class="flex flex-col gap-3">
        <template x-for="(toast, index) in visibleToasts" :key="toast.id">
            <div
                x-show="toast.visible"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-90"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-90"
                class="flare-toast pointer-events-auto w-full max-w-sm"
                :class="{
                    'opacity-100': expanded || index === 0,
                    'opacity-70 hover:opacity-100': !expanded && index > 0
                }"
            >
                <div class="bg-white dark:bg-zinc-800 rounded-lg shadow-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden">
                    <div class="p-4">
                        <div class="flex items-start gap-3">
                            <!-- Icon based on variant -->
                            <div class="flex-shrink-0 mt-0.5">
                                <!-- Success Icon -->
                                <svg x-show="toast.variant === 'success'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-green-500">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                                </svg>

                                <!-- Warning Icon -->
                                <svg x-show="toast.variant === 'warning'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-amber-500">
                                    <path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                                </svg>

                                <!-- Danger Icon -->
                                <svg x-show="toast.variant === 'danger'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-red-500">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                                </svg>

                                <!-- Default Icon (info) -->
                                <svg x-show="!toast.variant || (toast.variant !== 'success' && toast.variant !== 'warning' && toast.variant !== 'danger')" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-blue-500">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z" clip-rule="evenodd" />
                                </svg>
                            </div>

                            <!-- Content -->
                            <div class="flex-1 min-w-0">
                                <div x-show="toast.heading" x-html="toast.heading" class="font-semibold text-sm text-zinc-900 dark:text-zinc-100 mb-1"></div>
                                <div x-html="toast.text" class="text-sm text-zinc-700 dark:text-zinc-300" :class="{ 'font-medium': !toast.heading }"></div>
                            </div>

                            <!-- Close button -->
                            <button
                                x-on:click="dismissToast(toast.id)"
                                type="button"
                                class="flex-shrink-0 inline-flex rounded-md p-1.5 text-zinc-400 hover:text-zinc-500 dark:hover:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-zinc-800"
                            >
                                <span class="sr-only">Dismiss</span>
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                                </svg>
                            </button>
                        </div>

                        <!-- Progress bar for timed toasts -->
                        <div x-show="toast.duration > 0" class="mt-3 -mb-2 -mx-4 px-4">
                            <div class="h-1 bg-zinc-200 dark:bg-zinc-700 rounded-full overflow-hidden">
                                <div
                                    class="h-full bg-zinc-400 dark:bg-zinc-500 transition-all ease-linear"
                                    :style="'width: ' + toast.progress + '%; transition-duration: 100ms'"
                                ></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>
</div>
