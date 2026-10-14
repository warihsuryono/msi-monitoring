<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IspuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(int $device_id)
    {
        $data = null;
        $sensors = DB::connection('msi_devel')->table('Sensors')->where('Device_id', $device_id)->orderBy('id')->get();
        if ($sensors) foreach ($sensors as $sensor)
            $data[$sensor->sensor_name] = DB::connection('msi_devel')->table('Sensor_logs')->where('sensor_id', $sensor->id)->orderByDesc('timestamp')->first()->value ?? 0;

        $ispu = DB::connection('msi_devel')->table('ispu')->where('device_id', $device_id)->orderByDesc('start_at')->first();
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
            $data['ispu']['description'] = $ispu->description;
        }


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
