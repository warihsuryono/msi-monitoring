@vite(['resources/css/app.css', 'resources/js/app.js'])
@php
    use App\Livewire\DeviceWidget;
    use App\Models\Device;
@endphp
@if (Device::first())
    <x-filament-panels::page x-data="{ activeTab: 'device_{{ Device::first()->id }}' }">
        <x-filament::tabs>
            @foreach (Device::all() as $device)
                <x-filament::tabs.item x-on:click="activeTab = 'device_{{ $device->id }}'"
                    alpine-active="activeTab === 'device_{{ $device->id }}'">
                    {{ $device->name }}
                </x-filament::tabs.item>
            @endforeach
        </x-filament::tabs>
        <div>
            @foreach (Device::all() as $device)
                <div x-show="activeTab === 'device_{{ $device->id }}'">
                    @foreach ($this->p_types as $p_type)
                        @if ($this->i_param[$p_type][$device->id] > 0)
                            <br>
                            <h1 class="stat-subtitle"><b>{{ ucwords($p_type) }}</b></h1><br>
                            <div>@livewire(DeviceWidget::class, [$device->id, $p_type])</div>
                        @endif
                    @endforeach
                </div>
            @endforeach
        </div>
    </x-filament-panels::page>
@else
    <x-filament-panels::page>
    </x-filament-panels::page>
@endif
