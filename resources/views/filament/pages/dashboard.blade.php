@vite(['resources/css/app.css', 'resources/js/app.js'])
@php
    use App\Livewire\DeviceWidget;
    use App\Livewire\UnitToggle;
    use App\Models\Device;
@endphp
@if ($this->devices->count() > 0)
    <x-filament-panels::page x-data="{ activeTab: 'device_{{ $this->devices->first()->id }}' }">
        <x-filament::tabs>
            @foreach ($this->devices as $device)
                <x-filament::tabs.item x-on:click="activeTab = 'device_{{ $device->id }}'"
                    alpine-active="activeTab === 'device_{{ $device->id }}'">
                    {{ $device->name }}
                </x-filament::tabs.item>
            @endforeach
        </x-filament::tabs>

        @foreach ($this->devices as $device)
            <div x-show="activeTab === 'device_{{ $device->id }}'">
                @foreach ($this->p_types as $p_type)
                    @if ($this->i_param[$p_type][$device->id] > 0)
                        <br>
                        <h1 class="stat-subtitle"><b>{{ ucwords($p_type) }}</b></h1><br>
                        @if ($p_type == 'gas')
                            @livewire(UnitToggle::class, [$device->id])
                        @endif
                        <div>@livewire(DeviceWidget::class, [$device->id, $p_type])</div>
                    @endif
                @endforeach
                <br>
                Last Update :
                {{ $this->last_update[$device->id] ? $this->last_update[$device->id]->format('d-m-Y H:i:s') : '' }}
            </div>
        @endforeach
    </x-filament-panels::page>
@else
    <x-filament-panels::page>
        <div class="flex items-center justify-center min-h-[60vh]">
            <div class="text-center">
                <h2 class="text-xl font-semibold text-danger-600">
                    Device Tidak Ditemukan
                </h2>

                <p class="mt-2 text-gray-500">
                    Data device yang Anda cari tidak tersedia.
                </p>
            </div>
        </div>
    </x-filament-panels::page>
@endif
