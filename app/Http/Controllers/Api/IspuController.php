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
