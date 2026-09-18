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
        Schema::create('analyzer_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('device_id')->default(0)->nullable()->index();
            $table->unsignedBigInteger('parameter_id')->default(0)->nullable()->index();
            $table->double('value')->nullable()->default(0);
            $table->smallInteger('is_ispu')->default(0)->nullable()->index();
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
        Schema::dropIfExists('analyzer_values');
    }
};
