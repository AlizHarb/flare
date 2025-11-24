/**
 * Flare Toast Notifications - TypeScript Definitions
 * Version: 1.1.0
 */

declare global {
    interface Window {
        Flare: FlareAPI;
        Alpine: any;
        flareConfig?: FlareConfig;
    }
}

/**
 * Toast variant types
 */
export type ToastVariant = 'success' | 'warning' | 'danger' | 'info';

/**
 * Toast position types
 */
export type ToastPosition =
    | 'top start'
    | 'top center'
    | 'top end'
    | 'bottom start'
    | 'bottom center'
    | 'bottom end';

/**
 * Toast priority levels
 */
export type ToastPriority = 0 | 1 | 2 | 3 | 'low' | 'normal' | 'high' | 'urgent';

/**
 * Toast template names
 */
export type ToastTemplate = 'saved' | 'deleted' | 'error' | 'loading';

/**
 * Action button configuration
 */
export interface ToastAction {
    /** Button label */
    label: string;
    /** Optional callback function */
    callback?: () => void;
    /** Optional URL to navigate to */
    url?: string;
    /** Whether to dismiss toast after action (default: true) */
    dismiss?: boolean;
    /** Button variant */
    variant?: 'primary' | 'secondary' | 'danger';
}

/**
 * Toast options
 */
export interface ToastOptions {
    /** Optional heading text */
    heading?: string;
    /** Toast variant */
    variant?: ToastVariant;
    /** Duration in milliseconds (0 for persistent) */
    duration?: number;
    /** Toast position */
    position?: ToastPosition;
    /** Custom icon HTML or SVG */
    icon?: string;
    /** Action buttons */
    actions?: ToastAction[];
    /** Priority level */
    priority?: ToastPriority;
    /** Group identifier */
    group?: string;
    /** Sound URL to play */
    sound?: string;
}

/**
 * Template data
 */
export interface TemplateData {
    /** Custom message */
    message?: string;
    /** Additional options */
    [key: string]: any;
}

/**
 * Flare configuration
 */
export interface FlareConfig {
    /** Icon settings */
    icons?: {
        enabled: boolean;
    };
    /** Action button settings */
    actions?: {
        enabled: boolean;
        max_per_toast: number;
    };
    /** Priority system settings */
    priority?: {
        enabled: boolean;
        default: number;
    };
    /** Rate limiting settings */
    rate_limit?: {
        enabled: boolean;
        max_toasts: number;
        time_window: number;
    };
    /** Toast history settings */
    history?: {
        enabled: boolean;
        max_items: number;
    };
    /** Sound settings */
    sound?: {
        enabled: boolean;
    };
    /** Progress bar settings */
    progress_bar?: {
        enabled: boolean;
        position: 'top' | 'bottom';
    };
}

/**
 * Main Flare API
 */
export interface FlareAPI {
    /**
     * Show a toast notification
     * @param text - Main message text
     * @param options - Toast options
     */
    toast(text: string, options?: ToastOptions): void;

    /**
     * Show a success toast
     * @param text - Main message text
     * @param options - Toast options
     */
    success(text: string, options?: ToastOptions): void;

    /**
     * Show a warning toast
     * @param text - Main message text
     * @param options - Toast options
     */
    warning(text: string, options?: ToastOptions): void;

    /**
     * Show a danger toast
     * @param text - Main message text
     * @param options - Toast options
     */
    danger(text: string, options?: ToastOptions): void;

    /**
     * Show an error toast (alias for danger)
     * @param text - Main message text
     * @param options - Toast options
     */
    error(text: string, options?: ToastOptions): void;

    /**
     * Show an info toast
     * @param text - Main message text
     * @param options - Toast options
     */
    info(text: string, options?: ToastOptions): void;

    /**
     * Show a toast using a pre-defined template
     * @param name - Template name
     * @param data - Template data
     */
    template(name: ToastTemplate, data?: TemplateData): void;
}

export {};
