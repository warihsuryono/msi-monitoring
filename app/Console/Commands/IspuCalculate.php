<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class IspuCalculate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:ispu-calculate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $cutoff = Carbon::today()->setTime(15, 0, 0);
        $start = Carbon::yesterday()->setTime(15, 0, 0);
        $end   = $cutoff;
        if (Carbon::now()->lessThan($cutoff)) {
            $start = Carbon::today()->subDays(2)->setTime(15, 0, 0);
            $end   = Carbon::yesterday()->setTime(15, 0, 0);
        }

        $ispudata = [];
        $sensors = DB::connection('msi_devel')
            ->table('Sensors')
            ->whereIn('sensor_name', [
                'SO2',
                'NO2',
                'O3',
                'CO',
                'HC',
                'NMHC',
                'PM2.5',
                'PM10',
            ])
            ->get();

        foreach ($sensors as $sensor) {
            $this->info($sensor->device_id . ":" . $sensor->sensor_name . ":");
            $avg_value = DB::connection('msi_devel')
                ->table('Sensor_logs')
                ->where('sensor_id', $sensor->id)
                ->whereBetween('timestamp', [
                    $start->timestamp,
                    $end->timestamp,
                ])
                ->avg('value');


            $ispu = 0;
            $fieldname = "";
            if ($sensor->sensor_name == 'SO2') {
                $avg_value = $avg_value * 2.619;
                $ispu = $this->getIspu('so2', $avg_value ?? 0.0);
                $fieldname = "so2";
            }
            if ($sensor->sensor_name == 'NO2') {
                $avg_value = $avg_value * 1.881;
                $ispu = $this->getIspu('no2', $avg_value ?? 0.0);
                $fieldname = "no2";
            }
            if ($sensor->sensor_name == 'O3') {
                $avg_value = $avg_value * 1.962;
                $ispu = $this->getIspu('o3', $avg_value ?? 0.0);
                $fieldname = "o3";
            }
            if ($sensor->sensor_name == 'CO') {
                $avg_value = $avg_value * 1145.085;
                $ispu = $this->getIspu('co', $avg_value ?? 0.0);
                $fieldname = "co";
            }
            if ($sensor->sensor_name == 'HC' || $sensor->sensor_name == 'NMHC') {
                $avg_value = $avg_value * 2290;
                $ispu = $this->getIspu('hc', $avg_value ?? 0.0);
                $fieldname = "hc";
            }
            if ($sensor->sensor_name == 'PM2.5') {
                $ispu = $this->getIspu('pm25', $avg_value ?? 0.0);
                $fieldname = "pm25";
            }
            if ($sensor->sensor_name == 'PM10') {
                $ispu = $this->getIspu('pm10', $avg_value ?? 0.0);
                $fieldname = "pm10";
            }

            $ispudata[$sensor->device_id]['start_at'] = $start->format('Y-m-d H:i:s');
            $ispudata[$sensor->device_id]['end_at'] = $end->format('Y-m-d H:i:s');
            $ispudata[$sensor->device_id][$fieldname . '_avg'] = $avg_value;
            $ispudata[$sensor->device_id][$fieldname] = $ispu;

            if (!@$ispudata[$sensor->device_id]['higest_param']) $ispudata[$sensor->device_id]['higest_param'] = "";
            if (!@$ispudata[$sensor->device_id]['higest_avg']) $ispudata[$sensor->device_id]['higest_avg'] = 0;
            if (!@$ispudata[$sensor->device_id]['higest_ispu']) $ispudata[$sensor->device_id]['higest_ispu'] = 0;
            if ($ispu > $ispudata[$sensor->device_id]['higest_ispu']) {
                $ispudata[$sensor->device_id]['higest_param'] = $sensor->sensor_name;
                $ispudata[$sensor->device_id]['higest_avg'] = $avg_value;
                $ispudata[$sensor->device_id]['higest_ispu'] = $ispu;
            }
        }

        foreach ($ispudata as $device_id => $_ispudata) {
            DB::connection('msi_devel')->table('ispu')->where(['device_id' => $device_id, 'start_at' => $_ispudata['start_at'], 'end_at' => $_ispudata['end_at']])->delete();

            DB::connection('msi_devel')
                ->table('ispu')
                ->insert([
                    'device_id' => $device_id,
                    'start_at'  => $_ispudata['start_at'],
                    'end_at'    => $_ispudata['end_at'],
                    'pm25_avg'  => $_ispudata['pm25_avg'] ?? 0,
                    'pm25'      => $_ispudata['pm25'] ?? 0,
                    'pm10_avg'  => $_ispudata['pm10_avg'] ?? 0,
                    'pm10'      => $_ispudata['pm10'] ?? 0,
                    'so2_avg'   => $_ispudata['so2_avg'] ?? 0,
                    'so2'       => $_ispudata['so2'] ?? 0,
                    'co_avg'    => $_ispudata['co_avg'] ?? 0,
                    'co'        => $_ispudata['co'] ?? 0,
                    'o3_avg'    => $_ispudata['o3_avg'] ?? 0,
                    'o3'        => $_ispudata['o3'] ?? 0,
                    'no2_avg'   => $_ispudata['no2_avg'] ?? 0,
                    'no2'       => $_ispudata['no2'] ?? 0,
                    'hc_avg'    => $_ispudata['hc_avg'] ?? 0,
                    'hc'        => $_ispudata['hc'] ?? 0,
                    'higest_param'  => $_ispudata['higest_param'],
                    'higest_avg'    => $_ispudata['higest_avg'],
                    'higest_ispu'   => $_ispudata['higest_ispu'],
                    'description'   => $this->getIspuStatus($_ispudata['higest_ispu']),
                ]);
        }
    }


    public function getIspu(String $parameter, float $value)
    {
        $ispuConvertions = DB::connection('msi_devel')->table('ispu_convertions')->orderBy("ispu_range_start")->get();
        $maxIspu = DB::connection('msi_devel')->table('ispu_convertions')->orderBy('ispu_range_start', 'desc')->first();
        if ($value >= $maxIspu->$parameter) {
            return 500;
        }
        $Ia = 50; //Ispu batas atas 
        $Ib = 0; // Ispu batas bawah
        $Xa = 0; //konsentrasi batas atas
        $Xb = 0; // konsentrasi batas bawah
        $Xx = $value; // konsentrasi ambien nyata
        foreach ($ispuConvertions as $key => $dataIspu) {
            $beforeValue = $ispuConvertions[$key - 1]->$parameter ?? 0;
            // $nextValue = $ispuConvertions[$key+1]->$parameter ?? $maxIspu->$parameter;
            if ($value <= $dataIspu->$parameter && $value >= $beforeValue) {
                $Xa = $dataIspu->$parameter;
                $Ia = $dataIspu->ispu_range_end;
                $Ib = $dataIspu->ispu_range_start;
                $Xb = $beforeValue;
            }
        }
        $this->info("((($Ia - $Ib) / ($Xa - $Xb)) * ($Xx - $Xb)) + $Ib\n");
        $I = round(((($Ia - $Ib) / ($Xa - $Xb)) * ($Xx - $Xb)) + $Ib);
        return $I;
    }

    public function getIspuStatus(float $ispu)
    {
        if ($ispu <= 50) return 'Baik';
        elseif ($ispu <= 100) return 'Sedang';
        elseif ($ispu <= 200) return 'Tidak Sehat';
        elseif ($ispu <= 300) return 'Sangat Tidak Sehat';
        else return 'Berbahaya';
    }
}
