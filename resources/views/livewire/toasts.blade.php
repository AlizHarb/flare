<div
    x-data="flareToasts({
        position: '{{ $position }}',
        expanded: {{ $expanded ? 'true' : 'false' }},
        maxVisible: {{ config('flare.max_visible', 3) }},
        enableStacking: {{ config('flare.enable_stacking', true) ? 'true' : 'false' }}
    })"
    x-on:flare-toast-show.window="showToast($event.detail)"
    @mouseenter="enableStacking && expandOnHover()"
    @mouseleave="enableStacking && collapseOnLeave()"
    wire:ignore
    data-flare-container
    data-theme="{{ config('flare.theme', 'modern') }}"
    :data-position="position.replace(' ', '-')"
    :data-expanded="expanded ? 'true' : 'false'"
    :data-stacking="enableStacking ? 'true' : 'false'"
>
    <div class="relative">
        {{ $slot ?? '' }}
        <template x-for="(toast, index) in visibleToasts" :key="toast.id">
            <div
                x-show="toast.visible"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-90"
                data-flare-toast
                :data-variant="toast.variant"
                :data-state="toast.state"
                :data-paused="toast.paused ? 'true' : 'false'"
                x-on:mouseenter="pauseToast(toast.id)"
                x-on:mouseleave="resumeToast(toast.id)"
                tabindex="0"
                role="alert"
                aria-live="polite"
                class="group"
            >
                <div data-flare-content>
                    <!-- Icon -->
                    <div 
                        data-flare-icon 
                        :data-variant="toast.variant"
                        class="transition-transform duration-200 group-hover:scale-110"
                    >
                        <!-- Custom Icon -->
                        <div x-show="toast.icon" x-html="toast.icon"></div>

                        <!-- Success Icon -->
                        <svg x-show="!toast.icon && toast.variant === 'success'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                        </svg>

                        <!-- Warning Icon -->
                        <svg x-show="!toast.icon && toast.variant === 'warning'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                        </svg>

                        <!-- Danger Icon -->
                        <svg x-show="!toast.icon && toast.variant === 'danger'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                        </svg>

                        <!-- Info Icon -->
                        <svg x-show="!toast.icon && (!toast.variant || toast.variant === 'info')" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z" clip-rule="evenodd" />
                        </svg>
                    </div>

                    <!-- Content -->
                    <div data-flare-text>
                        <div 
                            x-show="toast.heading" 
                            x-html="toast.heading" 
                            data-flare-heading
                        ></div>
                        <div 
                            x-html="toast.text" 
                            data-flare-message
                        ></div>

                        <!-- Action Buttons -->
                        <div 
                            x-show="toast.actions && toast.actions.length > 0" 
                            class="mt-3 flex gap-2 ltr:flex-row rtl:flex-row-reverse"
                        >
                            <template x-for="(action, actionIndex) in toast.actions" :key="actionIndex">
                                <button
                                    @click="handleAction(toast.id, action)"
                                    type="button"
                                    class="inline-flex items-center px-3.5 py-2 text-xs font-semibold rounded-lg transition-all duration-200 hover:scale-105 active:scale-95 shadow-sm"
                                    :class="{
                                        'bg-gradient-to-r from-blue-600 to-blue-500 text-white hover:from-blue-700 hover:to-blue-600 shadow-blue-500/25': action.variant === 'primary',
                                        'bg-white/80 dark:bg-zinc-800/80 text-zinc-900 dark:text-zinc-100 hover:bg-white dark:hover:bg-zinc-700 border border-zinc-200 dark:border-zinc-700': !action.variant || action.variant === 'secondary',
                                        'bg-gradient-to-r from-red-600 to-red-500 text-white hover:from-red-700 hover:to-red-600 shadow-red-500/25': action.variant === 'danger'
                                    }"
                                    x-text="action.label"
                                ></button>
                            </template>
                        </div>
                    </div>

                    <!-- Close button -->
                    <button
                        x-on:click="dismissToast(toast.id)"
                        type="button"
                        data-flare-close
                        aria-label="Dismiss notification"
                    >
                        <span class="sr-only">Dismiss</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                        </svg>
                    </button>
                </div>

                <!-- Progress bar for timed toasts -->
                <div
                    x-show="toast.duration > 0 && {{ config('flare.progress_bar.enabled', true) ? 'true' : 'false' }}"
                    class="absolute bottom-0 inset-x-0 h-1 bg-black/5 dark:bg-white/5 overflow-hidden"
                    role="progressbar"
                    :aria-valuenow="toast.progress"
                    aria-valuemin="0"
                    aria-valuemax="100"
                >
                    <div
                        class="h-full transition-all ease-linear shadow-sm"
                        :class="{
                            'bg-gradient-to-r from-green-500 to-emerald-500': toast.variant === 'success',
                            'bg-gradient-to-r from-amber-500 to-orange-500': toast.variant === 'warning',
                            'bg-gradient-to-r from-red-500 to-rose-500': toast.variant === 'danger',
                            'bg-gradient-to-r from-blue-500 to-indigo-500': !toast.variant || toast.variant === 'info'
                        }"
                        :style="'width: ' + toast.progress + '%; transition-duration: 100ms'"
                    ></div>
                </div>
            </div>
        </template>
    </div>
</div>
