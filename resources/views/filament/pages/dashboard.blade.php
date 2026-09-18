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
                    <p class="font-bold">{{ $device->code }}</p>
                    <div>
                        @livewire(DeviceWidget::class, [$device->id])
                    </div>
                </div>
            @endforeach
        </div>
    </x-filament-panels::page>
@else
    <x-filament-panels::page>
    </x-filament-panels::page>
@endif
