<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Device;

class UnitToggle extends Component
{
    public int $unit_state = 0;
    public $device_id;

    public function mount($device_id): void
    {
        $this->device_id = $device_id;
        $this->unit_state = (int) Device::find($device_id)->unit_state;
    }

    public function changeUnit(): void
    {
        $this->unit_state++;
        if ($this->unit_state > 2) $this->unit_state = 0;
        Device::find($this->device_id)->update(['unit_state' => $this->unit_state]);
    }

    public function render()
    {
        return view('livewire.unit-toggle');
    }
}
