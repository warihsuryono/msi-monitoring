<?php

namespace App\Livewire;

use App\Models\AnalyzerValue;
use App\Models\DeviceParameter;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\HtmlString;

class DeviceWidget extends StatsOverviewWidget
{
    protected ?string $pollingInterval = '1s';
    public $device_id;
    public $p_type;
    public function mount($device_id, $p_type): void
    {
        $this->device_id = $device_id;
        $this->p_type = $p_type;
    }
    protected function getColumns(): int
    {
        return 4;
    }

    protected function getStats(): array
    {
        $stats = [];

        $device_parameters = DeviceParameter::where('device_id', $this->device_id)->whereHas('parameter', fn($q) => $q->where('p_type', $this->p_type))->get();

        if (!$device_parameters) return [];

        foreach ($device_parameters as $param) {

            $value = AnalyzerValue::where(['device_id' => $this->device_id, 'parameter_id' => $param->parameter_id])->latest('id')->first();
            $stats[] = Stat::make(
                $param->parameter_id,
                new HtmlString(
                    $value ? round($value->value) : '-' . " " .
                        "<a class='fi-wi-stats-overview-stat-unit'>" . $param->parameter->unit->name . "</a>"
                )
            )
                ->label(new HtmlString("<p class='text-lg font-black'>" . $param->parameter->caption . "</p>"))
                ->description(new HtmlString(""));
        }

        return $stats;
    }
}
