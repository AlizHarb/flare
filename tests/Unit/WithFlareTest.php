<?php

declare(strict_types=1);

use AlizHarb\Flare\Concerns\WithFlare;
use Livewire\Component;
use Livewire\Livewire;

class TestComponentWithFlare extends Component
{
    use WithFlare;

    public function triggerSuccess(): void
    {
        $this->flareSuccess('Success message');
    }

    public function triggerWarning(): void
    {
        $this->flareWarning('Warning message');
    }

    public function triggerDanger(): void
    {
        $this->flareDanger('Danger message');
    }

    public function triggerError(): void
    {
        $this->flareError('Error message');
    }

    public function triggerInfo(): void
    {
        $this->flareInfo('Info message');
    }

    public function triggerToast(): void
    {
        $this->flareToast('Toast message', 'Heading', 3000, 'success', 'top center');
    }

    public function render()
    {
        return '<div>Test Component</div>';
    }
}

test('WithFlare trait can be used in Livewire component', function () {
    expect(new TestComponentWithFlare())->toBeInstanceOf(Component::class);
});

test('flareSuccess dispatches event without errors', function () {
    Livewire::test(TestComponentWithFlare::class)
        ->call('triggerSuccess')
        ->assertDispatched('flare-toast-show');
});

test('flareWarning dispatches event without errors', function () {
    Livewire::test(TestComponentWithFlare::class)
        ->call('triggerWarning')
        ->assertDispatched('flare-toast-show');
});

test('flareDanger dispatches event without errors', function () {
    Livewire::test(TestComponentWithFlare::class)
        ->call('triggerDanger')
        ->assertDispatched('flare-toast-show');
});

test('flareError dispatches event without errors', function () {
    Livewire::test(TestComponentWithFlare::class)
        ->call('triggerError')
        ->assertDispatched('flare-toast-show');
});

test('flareInfo dispatches event without errors', function () {
    Livewire::test(TestComponentWithFlare::class)
        ->call('triggerInfo')
        ->assertDispatched('flare-toast-show');
});

test('flareToast dispatches event with all parameters', function () {
    Livewire::test(TestComponentWithFlare::class)
        ->call('triggerToast')
        ->assertDispatched('flare-toast-show');
});
