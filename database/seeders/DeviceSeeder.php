<?php

namespace Database\Seeders;

use App\Models\Device;
use App\Models\DeviceParameter;
use App\Models\QualityStandard;
use Illuminate\Database\Seeder;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Device::create(['id' => 1, 'name' => 'MSI FS1', 'topic' => 'msi/sensor/msifs1', 'device_type_id' => 1, 'address' => 'Duta Indah Starhub Jl Saluran Irigasi Cisadane Timur Blok X17 Kec. Benda, Kota Tangerang, Banten 15123', 'latitude' => '106.6623', 'longitude' => '-6.1289']);
        Device::create(['id' => 2, 'name' => 'MS Nova', 'topic' => 'msi/sensor/msnova', 'device_type_id' => 1, 'address' => 'Duta Indah Starhub Jl Saluran Irigasi Cisadane Timur Blok X17 Kec. Benda, Kota Tangerang, Banten 15123', 'latitude' => '106.6623', 'longitude' => '-6.1289']);

        DeviceParameter::create(['device_id' => 1, 'parameter_id' => 1, 'iot_code' => 'so2']);
        DeviceParameter::create(['device_id' => 1, 'parameter_id' => 2, 'iot_code' => 'no2']);
        DeviceParameter::create(['device_id' => 1, 'parameter_id' => 3, 'iot_code' => 'o3']);
        DeviceParameter::create(['device_id' => 1, 'parameter_id' => 4, 'iot_code' => 'co']);
        DeviceParameter::create(['device_id' => 1, 'parameter_id' => 6, 'iot_code' => 'hc']);
        DeviceParameter::create(['device_id' => 1, 'parameter_id' => 11, 'iot_code' => 'pm25']);
        DeviceParameter::create(['device_id' => 1, 'parameter_id' => 12, 'iot_code' => 'pm10']);
        DeviceParameter::create(['device_id' => 1, 'parameter_id' => 14, 'iot_code' => 'temperature']);
        DeviceParameter::create(['device_id' => 1, 'parameter_id' => 15, 'iot_code' => 'humidity']);
        DeviceParameter::create(['device_id' => 1, 'parameter_id' => 16, 'iot_code' => 'pressure']);
        DeviceParameter::create(['device_id' => 1, 'parameter_id' => 17, 'iot_code' => 'ws']);
        DeviceParameter::create(['device_id' => 1, 'parameter_id' => 18, 'iot_code' => 'wd']);
        DeviceParameter::create(['device_id' => 1, 'parameter_id' => 19, 'iot_code' => 'rain_intensity']);
        DeviceParameter::create(['device_id' => 1, 'parameter_id' => 20, 'iot_code' => 'sr']);

        DeviceParameter::create(['device_id' => 2, 'parameter_id' => 5, 'iot_code' => 'co2']);
        DeviceParameter::create(['device_id' => 2, 'parameter_id' => 10, 'iot_code' => 'o2']);
        DeviceParameter::create(['device_id' => 2, 'parameter_id' => 11, 'iot_code' => 'pm25']);
        DeviceParameter::create(['device_id' => 2, 'parameter_id' => 12, 'iot_code' => 'pm10']);
        DeviceParameter::create(['device_id' => 2, 'parameter_id' => 13, 'iot_code' => 'tsp']);
        DeviceParameter::create(['device_id' => 2, 'parameter_id' => 14, 'iot_code' => 'temperature']);
        DeviceParameter::create(['device_id' => 2, 'parameter_id' => 15, 'iot_code' => 'humidity']);
        DeviceParameter::create(['device_id' => 2, 'parameter_id' => 16, 'iot_code' => 'pressure']);

        QualityStandard::create(['regulation_code' => 'PP22', 'parameter_id' => 1,  'value' => 150,   'unit_id' => 4]);
        QualityStandard::create(['regulation_code' => 'PP22', 'parameter_id' => 2,  'value' => 200,   'unit_id' => 4]);
        QualityStandard::create(['regulation_code' => 'PP22', 'parameter_id' => 3,  'value' => 150,   'unit_id' => 4]);
        QualityStandard::create(['regulation_code' => 'PP22', 'parameter_id' => 4,  'value' => 10000, 'unit_id' => 4]);
        QualityStandard::create(['regulation_code' => 'PP22', 'parameter_id' => 11, 'value' => 55,    'unit_id' => 4]);
        QualityStandard::create(['regulation_code' => 'PP22', 'parameter_id' => 12, 'value' => 75,    'unit_id' => 4]);
    }
}
