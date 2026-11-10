<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class IspuController extends Controller
{
    public function IspuCategory(int $index)
    {
        if ($index <= 50) return 'Baik';
        elseif ($index <= 100) return 'Sedang';
        elseif ($index <= 200) return 'Tidak Sehat';
        elseif ($index <= 300) return 'Sangat Tidak Sehat';
        else return 'Berbahaya';
    }
    /**
     * Display a listing of the resource.
     */
    public function index(int $device_id)
    {
        $datetime = Carbon::now()->locale('id')->floorMinute(10)->translatedFormat('d M Y H:i');
        if ($device_id != 9999) {
            $data = null;
            $device_name = DB::connection('msi_devel')->table('Devices')->find($device_id)->device_name ?? '';
            $data['device_name'] = $device_name;
            $data['datetime'] = $datetime;
            $sensors = DB::connection('msi_devel')->table('Sensors')->where('Device_id', $device_id)->orderBy('id')->get();
            if ($sensors) foreach ($sensors as $sensor)
                $data[$sensor->sensor_name] = DB::connection('msi_devel')->table('Sensor_logs')->where('sensor_id', $sensor->id)->orderByDesc('timestamp')->first()->value ?? 0;

            if (!@$data['HC']) $data['HC'] = 0;
            if (!@$data['SO2']) $data['SO2'] = 0;
            $data['Temperature'] = number_format((float) $data['Temperature'] * 0.1, 1, '.', '');
            $ispu = DB::connection('msi_devel')->table('ispu')->where('device_id', $device_id)->where('is_outdoor', 1)->orderByDesc('start_at')->first();
            $cat_pm25 = " ";
            $cat_pm10 = " ";
            $cat_so2 = " ";
            $cat_co = " ";
            $cat_o3 = " ";
            $cat_no2 = " ";
            $cat_hc = " ";
            if ($ispu) {
                $data['ispu']['date'] = date('d/m/Y H:i', strtotime($ispu->start_at)) . " s/d " . date('d/m/Y H:i', strtotime($ispu->end_at));
                $data['ispu']['pm25'] = $ispu->pm25;
                $data['ispu']['pm10'] = $ispu->pm10;
                $data['ispu']['so2'] = $ispu->so2;
                $data['ispu']['co'] = $ispu->co;
                $data['ispu']['o3'] = $ispu->o3;
                $data['ispu']['no2'] = $ispu->no2;
                $data['ispu']['hc'] = $ispu->hc;
                $data['ispu']['higest_param'] = $ispu->higest_param;
                $data['ispu']['higest_ispu'] = $ispu->higest_ispu;
                $data['ispu']['description'] = strtoupper($ispu->description);
                $cat_pm25 = $this->IspuCategory($ispu->pm25);
                $cat_pm10 = $this->IspuCategory($ispu->pm10);
                $cat_so2 = $this->IspuCategory($ispu->so2);
                $cat_co = $this->IspuCategory($ispu->co);
                $cat_o3 = $this->IspuCategory($ispu->o3);
                $cat_no2 = $this->IspuCategory($ispu->no2);
                $cat_hc = $this->IspuCategory($ispu->hc);
            }
        } else {
            $device_name = 'STASIUN TESTING';
            $data['device_name'] = $device_name;
            $data['datetime'] = $datetime;
            $sensors = DB::connection('msi_devel')->table('Sensors')->where('Device_id', $device_id)->orderBy('id')->get();
            $data['NO2'] = 39;
            $data['SO2'] = 34;
            $data['O3'] = 3;
            $data['CO'] = 0.003;
            $data['HC'] = 12;
            $data['PM2.5'] = 31;
            $data['PM10'] = 41;
            $data['TSP'] = 54;
            $data['Temperature'] = 30.6;
            $data['Humidity'] = 73;
            $data['Air Pressure'] = 1004.3;
            $data['Wind Speed'] = 1.2;
            $data['Wind Direction'] = 340;
            $cat_pm25 = "BAIK";
            $cat_pm10 = "BAIK";
            $cat_so2 = "SEDANG";
            $cat_co = "SEDANG";
            $cat_o3 = "TIDAK SEHAT";
            $cat_no2 = "TIDAK SEHAT";
            $cat_hc = "BERBAHAYA";
            $data['ispu']['date'] = Carbon::now()->format('d/m/Y') . " 15:00 s/d " . Carbon::now()->addDay()->format('d/m/Y') . " 15:00";
            $data['ispu']['pm10'] = 480;
            $data['ispu']['pm25'] = 400;
            $data['ispu']['so2'] = 300;
            $data['ispu']['co'] = 250;
            $data['ispu']['o3'] = 200;
            $data['ispu']['no2'] = 100;
            $data['ispu']['hc'] = 50;
            $data['ispu']['higest_param'] = 'PM10';
            $data['ispu']['higest_ispu'] = 480;
            $data['ispu']['description'] = 'BERBAHAYA';
        }
        $data["uppertext1"] = "PM2.5:" . $cat_pm25 . ", PM10:" . $cat_pm10 . ", SO2:" . $cat_so2 . ", ";
        $data["uppertext2"] = "CO:" . $cat_co . ", O3:" . $cat_o3 . ", NO2:" . $cat_no2 . ", HC:" . $cat_hc;
        $data["lowertext1"] = "Stasiun " . $device_name . ": " . $datetime . " ==> PM2.5:" . $data['PM2.5'] . "ug/m3, PM10:" . $data['PM10'] . "ug/m3, SO2:" . $data['SO2'] . "ppb, ";
        $data["lowertext2"] = "CO:" . $data['CO'] . "ppm, O3:" . $data['O3'] . "ppb, NO2:" . $data['NO2'] . "ppb, HC:" . $data['HC'] . "ppm, SUHU:" . $data['Temperature'] . "C, TEK:" . $data['Air Pressure'] . "mBar, WS:" . $data['Wind Speed'] . "m/s, WD:" . $data['Wind Direction'] . "deg";


        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Data ISPU tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
