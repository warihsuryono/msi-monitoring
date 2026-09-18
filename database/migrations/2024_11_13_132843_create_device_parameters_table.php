<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('device_parameters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('device_id')->constrained(table: 'devices', indexName: 'device_parameters_id')->default(1);
            $table->unsignedBigInteger('parameter_id')->default(0)->nullable();
            $table->string('iot_code')->nullable()->default('');
            $table->unsignedBigInteger('deleted_by')->default(0)->nullable();
            $table->unsignedBigInteger('created_by')->default(0)->nullable();
            $table->unsignedBigInteger('updated_by')->default(0)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('device_parameters');
    }
};
