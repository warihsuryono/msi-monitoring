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
        $data = DB::connection('msi_devel')
            ->table('sensors as sd')
            ->join('sensor_logs as sl', 'sd.id', '=', 'sl.sensor_id')
            ->where('sd.Device_id', $device_id)
            ->whereRaw('sl.id = (
                SELECT sl2.id
                FROM sensor_logs sl2
                WHERE sl2.sensor_id = sl.sensor_id
                ORDER BY sl2.timestamp DESC, sl2.id DESC
                LIMIT 1
            )')
            ->select('sd.sensor_name', 'sl.value', 'sl.timestamp')
            ->orderByDesc('sl.timestamp')
            ->get()
            ->unique('sensor_name')
            ->mapWithKeys(fn($item) => [
                strtolower($item->sensor_name) => (float) $item->value,
            ]);

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
