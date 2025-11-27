/**
 * Flare Toast Notifications - v1.1.0
 * A beautiful, feature-rich toast notification system for Laravel Livewire
 */

(function() {
    'use strict';

    // Alpine.js component for managing toasts
    function flareToasts(config) {
        return {
            toasts: [],
            history: [],
            position: config.position || 'bottom end',
            expanded: config.expanded === true,
            maxVisible: config.maxVisible || 3,
            enableStacking: config.enableStacking !== false, // Default to true
            nextId: 1,
            collapseTimer: null,
            isHovering: false,
            rateLimitTracker: [],

            get visibleToasts() {
                // Sort by priority (higher first), then by creation time
                const sorted = [...this.toasts].sort((a, b) => {
                    if (a.priority !== b.priority) {
                        return (b.priority || 1) - (a.priority || 1);
                    }
                    return a.id - b.id;
                });

                if (this.expanded) {
                    return sorted;
                }
                return sorted.slice(-this.maxVisible);
            },

            get hiddenCount() {
                if (this.expanded) return 0;
                return Math.max(0, this.toasts.length - this.maxVisible);
            },

            toggleExpanded() {
                this.expanded = !this.expanded;
            },

            expandOnHover() {
                if (this.collapseTimer) {
                    clearTimeout(this.collapseTimer);
                    this.collapseTimer = null;
                }

                this.isHovering = true;

                if (!this.expanded) {
                    this.expanded = true;
                }

                this.pauseAllToasts();
            },

            collapseOnLeave() {
                this.isHovering = false;

                if (this.collapseTimer) {
                    clearTimeout(this.collapseTimer);
                }

                this.collapseTimer = setTimeout(() => {
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
                this.setupKeyboardNavigation();
                this.startProgressUpdater();
            },

            setupKeyboardNavigation() {
                document.addEventListener('keydown', (e) => {
                    if (this.toasts.length === 0) return;

                    // Escape: Dismiss the most recent toast
                    if (e.key === 'Escape' && !e.shiftKey) {
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
                // Check rate limiting
                if (!this.checkRateLimit()) {
                    return;
                }

                const toast = {
                    id: this.nextId++,
                    text: params.slots?.text || '',
                    heading: params.slots?.heading || null,
                    variant: params.dataset?.variant || null,
                    position: params.dataset?.position || this.position,
                    duration: params.duration ?? 5000,
                    priority: params.dataset?.priority ?? 1,
                    icon: params.dataset?.icon || null,
                    actions: params.dataset?.actions || [],
                    group: params.dataset?.group || null,
                    sound: params.dataset?.sound || null,
                    visible: true,
                    paused: false,
                    state: 'entering',
                    remainingTime: params.duration ?? 5000,
                    timer: null,
                    startTime: null,
                    progress: 100,
                };

                this.toasts.push(toast);

                // Play sound if enabled
                if (toast.sound) {
                    this.playSound(toast.sound);
                }

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

                this.trackRateLimit();
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

            startProgressUpdater() {
                setInterval(() => {
                    this.toasts.forEach((toast, index) => {
                        if (toast.duration > 0 && !toast.paused && toast.startTime) {
                            const elapsed = Date.now() - toast.startTime;
                            const progress = Math.max(0, 100 - (elapsed / toast.duration * 100));
                            this.toasts[index].progress = progress;
                        }
                    });
                    this.toasts = [...this.toasts];
                }, 100);
            },

            pauseToast(id) {
                const index = this.toasts.findIndex(t => t.id === id);
                if (index === -1 || this.toasts[index].paused) return;

                const toast = this.toasts[index];

                if (toast.timer) {
                    clearTimeout(toast.timer);
                }

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

                const toast = this.toasts[index];
                if (toast.remainingTime > 0) {
                    this.startToastTimer(toast);
                }
            },

            dismissToast(id) {
                const index = this.toasts.findIndex(t => t.id === id);
                if (index === -1) return;

                const toast = this.toasts[index];

                // Add to history if enabled
                if (window.flareConfig?.history?.enabled) {
                    this.addToHistory(toast);
                }

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
            },

            dismissGroup(group) {
                this.toasts
                    .filter(t => t.group === group)
                    .forEach(toast => this.dismissToast(toast.id));
            },

            handleAction(toastId, action) {
                if (action.callback && typeof action.callback === 'function') {
                    action.callback();
                }

                if (action.url) {
                    window.location.href = action.url;
                }

                if (action.dismiss !== false) {
                    this.dismissToast(toastId);
                }
            },

            addToHistory(toast) {
                const maxHistory = window.flareConfig?.history?.max_items || 50;
                this.history.unshift({
                    ...toast,
                    dismissedAt: new Date().toISOString(),
                });

                if (this.history.length > maxHistory) {
                    this.history = this.history.slice(0, maxHistory);
                }
            },

            checkRateLimit() {
                if (!window.flareConfig?.rate_limit?.enabled) {
                    return true;
                }

                const maxToasts = window.flareConfig.rate_limit.max_toasts || 10;
                const timeWindow = (window.flareConfig.rate_limit.time_window || 60) * 1000;
                const now = Date.now();

                this.rateLimitTracker = this.rateLimitTracker.filter(
                    timestamp => timestamp > now - timeWindow
                );

                return this.rateLimitTracker.length < maxToasts;
            },

            trackRateLimit() {
                if (window.flareConfig?.rate_limit?.enabled) {
                    this.rateLimitTracker.push(Date.now());
                }
            },

            playSound(soundUrl) {
                if (!soundUrl) return;

                try {
                    const audio = new Audio(soundUrl);
                    audio.volume = 0.5;
                    audio.play().catch(() => {
                        // Ignore errors (e.g., autoplay policy)
                    });
                } catch (e) {
                    // Ignore errors
                }
            }
        };
    }

    // Global window.Flare API
    window.Flare = {
        /**
         * Show a toast notification
         * @param {string} text - Main message text
         * @param {Object} options - Toast options
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

            if (options.icon) {
                params.dataset.icon = options.icon;
            }

            if (options.actions) {
                params.dataset.actions = options.actions;
            }

            if (options.priority !== undefined) {
                params.dataset.priority = options.priority;
            }

            if (options.group) {
                params.dataset.group = options.group;
            }

            if (options.sound) {
                params.dataset.sound = options.sound;
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
        },

        info(text, options = {}) {
            this.toast(text, { ...options, variant: 'info' });
        },

        // Template methods
        template(name, data = {}) {
            const templates = {
                saved: {
                    text: data.message || 'Changes saved successfully',
                    heading: 'Saved',
                    variant: 'success',
                    duration: 3000,
                },
                deleted: {
                    text: data.message || 'Item deleted successfully',
                    heading: 'Deleted',
                    variant: 'danger',
                    duration: 3000,
                },
                error: {
                    text: data.message || 'An error occurred',
                    heading: 'Error',
                    variant: 'danger',
                    duration: 5000,
                },
                loading: {
                    text: data.message || 'Processing...',
                    variant: 'info',
                    duration: 0,
                },
            };

            if (templates[name]) {
                this.toast(templates[name].text, {
                    ...templates[name],
                    ...data
                });
            }
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
