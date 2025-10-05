<?php

declare(strict_types=1);

namespace AlizHarb\Flare\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Flare Facade for accessing toast notification functionality.
 *
 * @method static void toast(string $text, string|null $heading = null, int $duration = 5000, string|null $variant = null, string|null $position = null) Display a toast notification
 * @method static void success(string $text, string|null $heading = null, int $duration = 5000, string|null $position = null) Display a success toast notification
 * @method static void warning(string $text, string|null $heading = null, int $duration = 5000, string|null $position = null) Display a warning toast notification
 * @method static void danger(string $text, string|null $heading = null, int $duration = 5000, string|null $position = null) Display a danger/error toast notification
 * @method static void error(string $text, string|null $heading = null, int $duration = 5000, string|null $position = null) Display an error toast notification (alias for danger)
 * @method static void info(string $text, string|null $heading = null, int $duration = 5000, string|null $position = null) Display an info toast notification
 * @method static string scripts() Generate the Flare JavaScript include tag
 * @method static string styles() Generate the Flare CSS include tag
 *
 * @see \AlizHarb\Flare\FlareManager
 */
final class Flare extends Facade
{
    /**
     * Get the registered name of the component in the container.
     *
     * @return string The service container binding key
     */
    protected static function getFacadeAccessor(): string
    {
        return 'flare';
    }
}
