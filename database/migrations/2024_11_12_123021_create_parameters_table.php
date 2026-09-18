<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('parameters', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->default('');
            $table->string('caption')->nullable()->default('');
            $table->string('p_type', 20)->nullable()->default('')->comment('gas,particulate,liquid,weather,emission,flow,noise');
            $table->unsignedBigInteger('unit_id')->default(0)->nullable();
            $table->double('molecular_mass')->nullable()->default(0)->comment('(g/mol)');
            $table->unsignedBigInteger('deleted_by')->default(0)->nullable();
            $table->unsignedBigInteger('created_by')->default(0)->nullable();
            $table->unsignedBigInteger('updated_by')->default(0)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        DB::table('parameters')->insert([
            ['name' => 'SO2',  'caption' => 'SO<sub>2</sub>',  'p_type' => 'gas', 'molecular_mass' => 64.07, 'unit_id' => 4],
            ['name' => 'NO2',  'caption' => 'NO<sub>2</sub>',  'p_type' => 'gas', 'molecular_mass' => 46.01, 'unit_id' => 4],
            ['name' => 'O3',   'caption' => 'O<sub>3</sub>',   'p_type' => 'gas', 'molecular_mass' => 48.00, 'unit_id' => 4],
            ['name' => 'CO',   'caption' => 'CO',              'p_type' => 'gas', 'molecular_mass' => 28.01, 'unit_id' => 4],
            ['name' => 'CO2',   'caption' => 'CO<sub>2</sub>', 'p_type' => 'gas', 'molecular_mass' => 44.01, 'unit_id' => 4],
            ['name' => 'NMHC', 'caption' => 'NMHC',            'p_type' => 'gas', 'molecular_mass' => 0, 'unit_id' => 4],
            ['name' => 'HC',   'caption' => 'HC',              'p_type' => 'gas', 'molecular_mass' => 0, 'unit_id' => 4],
            ['name' => 'H2S',  'caption' => 'H<sub>2</sub>S',  'p_type' => 'gas', 'molecular_mass' => 34.08, 'unit_id' => 4],
            ['name' => 'CH4',  'caption' => 'CH<sub>4</sub>',  'p_type' => 'gas', 'molecular_mass' => 16.04, 'unit_id' => 4],
            ['name' => 'O2',    'caption' => 'O<sub>2</sub>',  'p_type' => 'gas', 'molecular_mass' => 32.00, 'unit_id' => 4],
            ['name' => 'PM2.5', 'caption' => 'PM<sub>2.5</sub>', 'p_type' => 'particulate', 'molecular_mass' => 0, 'unit_id' => 4],
            ['name' => 'PM10', 'caption' => 'PM<sub>10</sub>', 'p_type' => 'particulate', 'molecular_mass' => 0, 'unit_id' => 4],
            ['name' => 'TSP',  'caption' => 'TSP',             'p_type' => 'particulate', 'molecular_mass' => 0, 'unit_id' => 4],
            ['name' => 'Temperature',    'caption' => 'Temperature',     'p_type' => 'weather', 'molecular_mass' => 0, 'unit_id' => 10],
            ['name' => 'Humidity',       'caption' => 'Humidity',        'p_type' => 'weather', 'molecular_mass' => 0, 'unit_id' => 3],
            ['name' => 'Air Pressure',   'caption' => 'Air Pressure',    'p_type' => 'weather', 'molecular_mass' => 0, 'unit_id' => 12],
            ['name' => 'Wind Speed',     'caption' => 'Wind Speed',      'p_type' => 'weather', 'molecular_mass' => 0, 'unit_id' => 14],
            ['name' => 'Wind Direction', 'caption' => 'Wind Direction',  'p_type' => 'weather', 'molecular_mass' => 0, 'unit_id' => 15],
            ['name' => 'Rain Intensity', 'caption' => 'Rain Intensity',  'p_type' => 'weather', 'molecular_mass' => 0, 'unit_id' => 17],
            ['name' => 'Solar Radiation', 'caption' => 'Solar Radiation', 'p_type' => 'weather', 'molecular_mass' => 0, 'unit_id' => 18],
            ['name' => 'Flow',      'caption' => 'Flow',      'p_type' => 'flow', 'molecular_mass' => 0, 'unit_id' => 7],
            ['name' => 'PH',    'caption' => 'pH',    'p_type' => 'liquid', 'molecular_mass' => 0, 'unit_id' => 20],
            ['name' => 'NH3-N', 'caption' => 'NH<sub>3</sub>-N', 'p_type' => 'liquid', 'molecular_mass' => 0, 'unit_id' => 6],
            ['name' => 'TSS',   'caption' => 'TSS',   'p_type' => 'liquid', 'molecular_mass' => 0, 'unit_id' => 6],
            ['name' => 'COD',   'caption' => 'COD',   'p_type' => 'liquid', 'molecular_mass' => 0, 'unit_id' => 6],
            ['name' => 'Noise', 'caption' => 'Noise', 'p_type' => 'noise', 'molecular_mass' => 0, 'unit_id' => 19],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parameters');
    }
};
