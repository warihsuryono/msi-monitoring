<?php

namespace Database\Seeders;

use App\Models\AnalyzerValue;
use Illuminate\Database\Seeder;

class AnalyzerValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AnalyzerValue::create(['device_id' => 1, 'parameter_id' => 1, 'value' => 11]);
        AnalyzerValue::create(['device_id' => 1, 'parameter_id' => 2, 'value' => 22]);
        AnalyzerValue::create(['device_id' => 1, 'parameter_id' => 3, 'value' => 33]);
        AnalyzerValue::create(['device_id' => 1, 'parameter_id' => 4, 'value' => 44]);
        AnalyzerValue::create(['device_id' => 1, 'parameter_id' => 6, 'value' => 55]);
        AnalyzerValue::create(['device_id' => 1, 'parameter_id' => 11, 'value' => 66]);
        AnalyzerValue::create(['device_id' => 1, 'parameter_id' => 12, 'value' => 77]);
        AnalyzerValue::create(['device_id' => 1, 'parameter_id' => 14, 'value' => 32]);
        AnalyzerValue::create(['device_id' => 1, 'parameter_id' => 15, 'value' => 45]);
        AnalyzerValue::create(['device_id' => 1, 'parameter_id' => 16, 'value' => 1003.12]);
        AnalyzerValue::create(['device_id' => 1, 'parameter_id' => 17, 'value' => 2]);
        AnalyzerValue::create(['device_id' => 1, 'parameter_id' => 18, 'value' => 275]);
        AnalyzerValue::create(['device_id' => 1, 'parameter_id' => 19, 'value' => 11]);
        AnalyzerValue::create(['device_id' => 1, 'parameter_id' => 20, 'value' => 12]);
    }
}
