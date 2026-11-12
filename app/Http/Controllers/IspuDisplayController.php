<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class IspuDisplayController extends Controller
{
    /**
     * Halaman dashboard ISPU untuk satu device.
     */
    public function show(int $deviceId): View
    {
        $record = $this->latestRecord($deviceId);
        abort_if(!$record, 404, "Data ISPU untuk device {$deviceId} belum tersedia.");

        return view('ispu.display', [
            'deviceId' => $deviceId,
            'data' => $this->makePayload($record, $deviceId),
            'refreshSeconds' => max(10, (int) config('ispu_display.refresh_seconds', 30)),
        ]);
    }

    /**
     * Endpoint JSON yang dipanggil berkala oleh dashboard.
     */
    public function data(int $deviceId): JsonResponse
    {
        $record = $this->latestRecord($deviceId);
        abort_if(!$record, 404, "Data ISPU untuk device {$deviceId} belum tersedia.");

        return response()->json($this->makePayload($record, $deviceId));
    }

    private function latestRecord(int $deviceId): ?object
    {
        return DB::connection('msi_devel')->table('ispu')
            ->where('device_id', $deviceId)
            ->orderByDesc('end_at')
            ->orderByDesc('id')
            ->first();
    }

    private function makePayload(object $record, int $deviceId): array
    {
        $rawValues = [
            'pm10' => $record->pm10 ?? null,
            'pm25' => $record->pm25 ?? null,
            'so2'  => $record->so2 ?? null,
            'co'   => $record->co ?? null,
            'o3'   => $record->o3 ?? null,
            'no2'  => $record->no2 ?? null,
            'hc'   => $record->hc ?? null,
        ];

        // higest_ispu merupakan indeks ISPU tertinggi pada record harian.
        // Bila kosong, gunakan nilai tertinggi dari indeks masing-masing parameter.
        $numericValues = array_map(
            static fn($value) => is_numeric($value) ? (float) $value : 0.0,
            $rawValues
        );
        $mainValue = is_numeric($record->higest_ispu ?? null)
            ? (float) $record->higest_ispu
            : (max($numericValues) ?: 0.0);

        $category = $this->categoryFor($mainValue);
        $parameterLabels = [
            'pm10' => 'PM 10',
            'pm25' => 'PM 2,5',
            'so2'  => 'SO2',
            'co'   => 'CO',
            'o3'   => 'O3',
            'no2'  => 'NO2',
            'hc'   => 'HC',
        ];

        $parameters = [];
        foreach ($rawValues as $key => $value) {
            $number = is_numeric($value) ? (float) $value : 0.0;

            if ($number > 300) $height = $this->mapValue($number, 301, 500, 78, 96);
            else if ($number > 100) $height = $this->mapValue($number, 101, 300, 39, 77);
            else $height = $this->mapValue($number, 0, 100, 0, 38);

            $parameters[$key] = [
                'label' => $parameterLabels[$key],
                'value' => $number,
                'display' => $this->formatNumber($number),
                'color' => $this->categoryFor($number)['color'],
                // Skala tetap 0–500 agar seluruh parameter dapat dibandingkan.
                // 'height' => min(100, max(0, ($number / 500) * 100)),
                'height' => $height,
            ];
        }

        $mainParameter = trim((string) ($record->higest_param ?? ''));
        if ($mainParameter === '') {
            $mainParameter = '-';
        }


        $data = null;
        $sensors = DB::connection('msi_devel')->table('Sensors')->where('Device_id', $deviceId)->orderBy('id')->get();
        if ($sensors) foreach ($sensors as $sensor)
            $data[$sensor->sensor_name] = DB::connection('msi_devel')->table('Sensor_logs')->where('sensor_id', $sensor->id)->orderByDesc('timestamp')->first()->value ?? 0;

        if (!@$data['NO2']) $data['NO2'] = 0;
        if (!@$data['SO2']) $data['SO2'] = 0;
        if (!@$data['O3']) $data['O3'] = 0;
        if (!@$data['CO']) $data['CO'] = 0;
        if (!@$data['HC']) $data['HC'] = 0;
        if (!@$data['PM2.5']) $data['PM2.5'] = 0;
        if (!@$data['PM10']) $data['PM10'] = 0;
        if (!@$data['TSP']) $data['TSP'] = 0;
        if (!@$data['Temperature']) $data['Temperature'] = 0;
        if (!@$data['Humidity']) $data['Humidity'] = 0;
        if (!@$data['Air Pressure']) $data['Air Pressure'] = 0;
        if (!@$data['Wind Speed']) $data['Wind Speed'] = 0;
        if (!@$data['Wind Direction']) $data['Wind Direction'] = 0;
        $data['Temperature'] = number_format((float) $data['Temperature'] * 0.1, 1, '.', '');

        return [
            'deviceId' => $deviceId,
            'location' => DB::connection('msi_devel')->table('Devices')->find($deviceId)->device_name ?? config("ispu_display.locations.{$deviceId}", "AQMS Device #{$deviceId}"),
            'mainValue' => $this->formatNumber($mainValue),
            'mainParameter' => $mainParameter,
            'category' => $category['name'],
            'categoryColor' => $category['color'],
            'statusTitle' => 'KUALITAS UDARA ' . mb_strtoupper($category['name']),
            'statusIcon' => $category['icon'],
            'impactText' => $category['impact'],
            'startAt' => $this->formatDate($record->start_at ?? null),
            'endAt' => $this->formatDate($record->end_at ?? null),
            'updatedAt' => $this->formatDate($record->xtimetimes ?? null),
            'parameters' => $parameters,
            // Kolom meteorologi tidak tersedia pada struktur tabel ispu yang diberikan.
            'weather' => [
                'humidity' => $data['Humidity'],
                'pressure' => $data['Air Pressure'],
                'temperature' => $data['Temperature'],
            ],
        ];
    }

    private function categoryFor(float $value): array
    {
        // Rentang dan warna mengikuti legenda pada gambar referensi.
        if ($value <= 50) {
            return [
                'name' => 'Baik',
                'icon' => '😊',
                'color' => '#08ad50',
                'impact' => 'Tingkat kualitas udara sangat baik dan tidak memberikan efek negatif terhadap kesehatan manusia, hewan, maupun tumbuhan.',
            ];
        }

        if ($value <= 100) {
            return [
                'name' => 'Sedang',
                'icon' => '🙂',
                'color' => '#0878bd',
                'impact' => 'Kualitas udara masih dapat diterima. Namun, sebagian kecil kelompok yang sensitif dapat mengalami dampak kesehatan.',
            ];
        }

        if ($value <= 200) {
            return [
                'name' => 'Tidak Sehat',
                'icon' => '😐',
                'color' => '#ffe500',
                'impact' => 'Kualitas udara dapat merugikan kesehatan kelompok sensitif dan dapat memengaruhi kelompok masyarakat lainnya.',
            ];
        }

        if ($value <= 300) {
            return [
                'name' => 'Sangat Tidak Sehat',
                'icon' => '☹',
                'color' => '#ef3027',
                'impact' => 'Tingkat kualitas udara dapat meningkatkan risiko kesehatan pada sejumlah segmen populasi yang terpapar.',
            ];
        }

        return [
            'name' => 'Berbahaya',
            'icon' => '😷',
            'color' => '#111111',
            'impact' => 'Kualitas udara berada pada tingkat berbahaya. Kondisi ini dapat berdampak serius terhadap kesehatan masyarakat.',
        ];
    }

    private function formatDate(mixed $value): ?string
    {
        if (!$value) {
            return null;
        }

        return Carbon::parse($value)
            ->locale('id')
            ->translatedFormat('d F Y, H.i');
    }

    private function formatNumber(float $value): string
    {
        return rtrim(rtrim(number_format($value, 1, ',', '.'), '0'), ',');
    }

    public function mapValue(int $value, int $fromLow, int $fromHigh, int $toLow, int $toHigh)
    {
        return ($value - $fromLow) * ($toHigh - $toLow) / ($fromHigh - $fromLow) + $toLow;
    }
}
