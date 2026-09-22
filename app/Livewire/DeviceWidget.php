<?php

namespace App\Livewire;

use App\Models\AnalyzerValue;
use App\Models\Device;
use App\Models\DeviceParameter;
use App\Models\Parameter;
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

    public function get_value($parameter_id, $value, $unit_state)
    {
        $molecular_mass = (float) @Parameter::find($parameter_id)->first()->molecular_mass;
        if ($unit_state == 1 || $unit_state == 2) $value = round((24.45 * $value) / $molecular_mass, 3);
        if ($unit_state == 2) $value = round($value / 1000, 3);
        return $value;
    }

    public function get_unit($unit_state)
    {
        if ($unit_state == 0) return "µg/m<sup>3</sup>";
        if ($unit_state == 1) return "ppb";
        if ($unit_state == 2) return "ppm";
    }

    protected function getStats(): array
    {
        $stats = [];

        $device_parameters = DeviceParameter::where('device_id', $this->device_id)->whereHas('parameter', fn($q) => $q->where('p_type', $this->p_type))->get();

        if (!$device_parameters) return [];

        foreach ($device_parameters as $param) {
            $unit_state = (int) Device::find($this->device_id)->unit_state;
            $value = @AnalyzerValue::where(['device_id' => $this->device_id, 'parameter_id' => $param->parameter_id])->latest('id')->first()->value;
            $unit = $param->parameter->unit->name;
            if ($this->p_type == 'gas') {
                $value = $this->get_value($param->parameter_id, $value, $unit_state);
                $unit = $this->get_unit($unit_state);
            }

            $stats[] = Stat::make(
                $param->parameter_id,
                new HtmlString(
                    $value . " " .
                        "<a class='fi-wi-stats-overview-stat-unit'>" . $unit . "</a>"
                )
            )
                ->label(new HtmlString("<p class='text-lg font-black'>" . $param->parameter->caption . "</p>"))
                ->description(new HtmlString(""));
        }

        return $stats;
    }
}
