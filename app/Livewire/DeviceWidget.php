<?php

namespace App\Livewire;

use App\Models\AnalyzerValue;
use App\Models\Device;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\HtmlString;

class DeviceWidget extends StatsOverviewWidget
{
    protected ?string $pollingInterval = '1s';
    public $device_id;
    public function mount($device_id): void
    {
        $this->device_id = $device_id;
    }
    protected function getStats(): array
    {
        $stats = [];

        $device = Device::find($this->device_id);

        if (!$device) {
            return [];
        }

        foreach ($device->parameters as $param) {

            $value = AnalyzerValue::where([
                'device_id' => $this->device_id,
                'parameter_id' => $param->parameter_id
            ])
                ->latest('id')
                ->first();

            $stats[] = Stat::make(
                $param->parameter_id,
                $value ? round($value->value) : '-'
            )
                ->label(new HtmlString("<p class='text-lg font-black'>{$param->parameter->name}</p>"))
                ->description($param->parameter->unit->name);
        }

        return $stats;
    }
}
