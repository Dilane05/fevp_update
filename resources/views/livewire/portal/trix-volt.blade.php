<?php

use Livewire\Volt\Component;

new class extends Component
{
    const EVENT_VALUE_UPDATED = 'trix_volt_value_updated';

    public $value;
    public $trixVoltId;

    public function mount($value = '')
    {
        $this->value = $value;
        $this->trixVoltId = 'trix' . uniqid();
    }

    public function updatedValue($value)
    {
        $this->dispatch(self::EVENT_VALUE_UPDATED, $this->value);
    }
}; ?>

<div>
    <input id="{{ $trixVoltId }}" type="hidden" name="content" value="{{ $value }}">
    <trix-editor input="{{ $trixVoltId }}"></trix-editor>
    <script>
        var trixVoltEditor = document.getElementById("{{ $trixVoltId }}")

        addEventListener("trix-blur", function(event) {
            @this.set('value', trixVoltEditor.getAttribute('value'))
        })
    </script>
</div>