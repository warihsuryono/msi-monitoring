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
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->nullable()->default('');
            $table->unsignedBigInteger('deleted_by')->default(0)->nullable();
            $table->unsignedBigInteger('created_by')->default(0)->nullable();
            $table->unsignedBigInteger('updated_by')->default(0)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        DB::table('units')->insert([
            ['name' => 'ppm'],
            ['name' => 'ppb'],
            ['name' => '%'],
            ['name' => 'μg/m³'],
            ['name' => 'mg/m³'],
            ['name' => 'mg/l'],
            ['name' => 'l/min'],
            ['name' => 'm³/min'],
            ['name' => 'm³/h'],
            ['name' => '°C'],
            ['name' => '%RH'],
            ['name' => 'mBar'],
            ['name' => 'hPa'],
            ['name' => 'm/sec'],
            ['name' => '°'],
            ['name' => 'mm'],
            ['name' => 'mm/h'],
            ['name' => 'W/m2'],
            ['name' => 'dB'],
            ['name' => 'pH'],
            ['name' => 'minutes'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};
