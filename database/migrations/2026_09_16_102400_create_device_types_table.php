<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('device_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->default('');
            $table->string('regulation_code')->nullable()->default('')->index('device_type_regulation_code');
            $table->unsignedBigInteger('deleted_by')->default(0)->nullable();
            $table->unsignedBigInteger('created_by')->default(0)->nullable();
            $table->unsignedBigInteger('updated_by')->default(0)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        DB::table('device_types')->insert([
            ['name' => 'AQMS',  'regulation_code' => 'PP22'],
            ['name' => 'WQMS',  'regulation_code' => 'PP22'],
            ['name' => 'CEMS',  'regulation_code' => 'LHK11'],
            ['name' => 'BAM',  'regulation_code' => 'PP22'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('device_types');
    }
};
