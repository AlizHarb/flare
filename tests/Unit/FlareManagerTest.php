<?php

declare(strict_types=1);

use AlizHarb\Flare\FlareManager;

test('can instantiate FlareManager', function () {
    $manager = new FlareManager();

    expect($manager)->toBeInstanceOf(FlareManager::class);
});

test('generates correct script tag', function () {
    config(['flare.asset_path' => '/vendor/flare/flare.js']);

    $manager = new FlareManager();
    $scripts = $manager->scripts();

    expect($scripts)->toContain('<script')
        ->toContain('src=')
        ->toContain('/vendor/flare/flare.js')
        ->toContain('defer');
});

test('generates correct style tag', function () {
    config(['flare.css_path' => '/vendor/flare/flare.css']);

    $manager = new FlareManager();
    $styles = $manager->styles();

    expect($styles)->toContain('<link')
        ->toContain('rel="stylesheet"')
        ->toContain('/vendor/flare/flare.css');
});

test('toast methods do not throw errors', function () {
    $manager = new FlareManager();

    expect(fn() => $manager->toast('Test message'))->not->toThrow(Exception::class);
    expect(fn() => $manager->success('Success message'))->not->toThrow(Exception::class);
    expect(fn() => $manager->warning('Warning message'))->not->toThrow(Exception::class);
    expect(fn() => $manager->danger('Danger message'))->not->toThrow(Exception::class);
    expect(fn() => $manager->error('Error message'))->not->toThrow(Exception::class);
    expect(fn() => $manager->info('Info message'))->not->toThrow(Exception::class);
});

test('toast accepts all parameters', function () {
    $manager = new FlareManager();

    expect(fn() => $manager->toast(
        text: 'Test message',
        heading: 'Test heading',
        duration: 3000,
        variant: 'success',
        position: 'top center'
    ))->not->toThrow(Exception::class);
});
