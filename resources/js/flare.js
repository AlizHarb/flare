/**
 * Flare Toast Notifications
 * A beautiful toast notification system for Laravel Livewire
 */

(function() {
    'use strict';

    // Alpine.js component for managing toasts
    function flareToasts(config) {
    return {
        toasts: [],
        position: config.position || 'bottom end',
        expanded: config.expanded === true,
        maxVisible: config.maxVisible || 3,
        nextId: 1,
        collapseTimer: null,
        isHovering: false,

        get visibleToasts() {
            if (this.expanded) {
                return this.toasts;
            }
            return this.toasts.slice(-this.maxVisible);
        },

        get hiddenCount() {
            if (this.expanded) return 0;
            return Math.max(0, this.toasts.length - this.maxVisible);
        },

        toggleExpanded() {
            this.expanded = !this.expanded;
        },

        expandOnHover() {
            // Clear any pending collapse
            if (this.collapseTimer) {
                clearTimeout(this.collapseTimer);
                this.collapseTimer = null;
            }

            this.isHovering = true;

            // Only expand if not already expanded
            if (!this.expanded) {
                this.expanded = true;
            }

            // Pause all toasts
            this.pauseAllToasts();
        },

        collapseOnLeave() {
            this.isHovering = false;

            // Clear any existing timer
            if (this.collapseTimer) {
                clearTimeout(this.collapseTimer);
            }

            // Add delay before collapsing to allow moving between toasts
            this.collapseTimer = setTimeout(() => {
                // Only collapse if still not hovering
                if (!this.isHovering) {
                    this.expanded = false;
                    this.resumeAllToasts();
                }
                this.collapseTimer = null;
            }, 200);
        },

        pauseAllToasts() {
            this.toasts.forEach(toast => {
                if (!toast.paused && toast.duration > 0) {
                    this.pauseToast(toast.id);
                }
            });
        },

        resumeAllToasts() {
            this.toasts.forEach(toast => {
                if (toast.paused) {
                    this.resumeToast(toast.id);
                }
            });
        },

        init() {
            // Setup keyboard navigation
            this.setupKeyboardNavigation();
        },

        setupKeyboardNavigation() {
            document.addEventListener('keydown', (e) => {
                if (this.toasts.length === 0) return;

                // Escape: Dismiss the most recent toast
                if (e.key === 'Escape') {
                    const latestToast = this.toasts[this.toasts.length - 1];
                    if (latestToast) {
                        this.dismissToast(latestToast.id);
                    }
                }

                // Shift + Escape: Dismiss all toasts
                if (e.key === 'Escape' && e.shiftKey) {
                    e.preventDefault();
                    this.dismissAll();
                }

                // Alt/Option + D: Dismiss all toasts
                if ((e.altKey || e.metaKey) && e.key === 'd') {
                    e.preventDefault();
                    this.dismissAll();
                }
            });
        },

        showToast(params) {
            const toast = {
                id: this.nextId++,
                text: params.slots?.text || '',
                heading: params.slots?.heading || null,
                variant: params.dataset?.variant || null,
                position: params.dataset?.position || this.position,
                duration: params.duration ?? 5000,
                visible: true,
                paused: false,
                state: 'entering',
                remainingTime: params.duration ?? 5000,
                timer: null,
                startTime: null,
            };

            this.toasts.push(toast);

            // Set state to active after animation
            setTimeout(() => {
                const index = this.toasts.findIndex(t => t.id === toast.id);
                if (index !== -1) {
                    this.toasts[index].state = 'active';
                    this.toasts = [...this.toasts];
                }
            }, 300);

            // Auto-dismiss if duration is set
            if (toast.duration > 0) {
                this.startToastTimer(toast);
            }
        },

        startToastTimer(toast) {
            const index = this.toasts.findIndex(t => t.id === toast.id);
            if (index === -1) return;

            this.toasts[index].startTime = Date.now();

            this.toasts[index].timer = setTimeout(() => {
                this.dismissToast(toast.id);
            }, toast.remainingTime);

            this.toasts = [...this.toasts];
        },

        pauseToast(id) {
            const index = this.toasts.findIndex(t => t.id === id);
            if (index === -1 || this.toasts[index].paused) return;

            const toast = this.toasts[index];

            // Clear the timer
            if (toast.timer) {
                clearTimeout(toast.timer);
            }

            // Calculate remaining time
            const elapsed = Date.now() - toast.startTime;
            this.toasts[index].remainingTime = Math.max(0, toast.remainingTime - elapsed);
            this.toasts[index].paused = true;
            this.toasts = [...this.toasts];
        },

        resumeToast(id) {
            const index = this.toasts.findIndex(t => t.id === id);
            if (index === -1 || !this.toasts[index].paused) return;

            this.toasts[index].paused = false;
            this.toasts = [...this.toasts];

            // Restart the timer with remaining time
            const toast = this.toasts[index];
            if (toast.remainingTime > 0) {
                this.startToastTimer(toast);
            }
        },

        dismissToast(id) {
            const index = this.toasts.findIndex(t => t.id === id);
            if (index === -1) return;

            const toast = this.toasts[index];

            // Clear timers
            if (toast.timer) clearTimeout(toast.timer);

            // Set leaving state
            this.toasts[index].state = 'leaving';
            this.toasts[index].visible = false;
            this.toasts = [...this.toasts];

            // Remove from array after animation completes
            setTimeout(() => {
                this.toasts = this.toasts.filter(t => t.id !== id);
            }, 200);
        },

        dismissAll() {
            this.toasts.forEach(toast => {
                this.dismissToast(toast.id);
            });
        }
    };
    }

    // Global window.Flare API
    window.Flare = {
        /**
         * Show a toast notification
         * @param {string} text - Main message text
         * @param {Object} options - Toast options
         * @param {string} options.heading - Optional heading
         * @param {string} options.variant - Toast variant: success, warning, danger
         * @param {number} options.duration - Duration in ms (0 for persistent)
         * @param {string} options.position - Toast position
         */
        toast(text, options = {}) {
            const params = {
                duration: options.duration ?? 5000,
                slots: { text },
                dataset: {}
            };

            if (options.heading) {
                params.slots.heading = options.heading;
            }

            if (options.variant) {
                params.dataset.variant = options.variant;
            }

            if (options.position) {
                params.dataset.position = options.position;
            }

            window.dispatchEvent(new CustomEvent('flare-toast-show', {
                detail: params
            }));
        },

        // Convenience methods
        success(text, options = {}) {
            this.toast(text, { ...options, variant: 'success' });
        },

        warning(text, options = {}) {
            this.toast(text, { ...options, variant: 'warning' });
        },

        danger(text, options = {}) {
            this.toast(text, { ...options, variant: 'danger' });
        },

        error(text, options = {}) {
            this.toast(text, { ...options, variant: 'danger' });
        }
    };

    // Register with Alpine.js
    function registerWithAlpine() {
        if (typeof window.Alpine !== 'undefined') {
            window.Alpine.data('flareToasts', flareToasts);
            window.Alpine.magic('flare', () => window.Flare);
        }
    }

    // Try to register when Alpine initializes
    document.addEventListener('alpine:init', () => {
        registerWithAlpine();
    });

    // Also try when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(registerWithAlpine, 100);
        });
    } else {
        setTimeout(registerWithAlpine, 100);
    }
})();
