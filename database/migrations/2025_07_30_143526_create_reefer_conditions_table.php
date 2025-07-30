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
        Schema::create('reefer_conditions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->string('description', 200)->nullable();
            $table->string('temperature_range', 200)->nullable(); // Ej: "-30°C a +30°C"
            $table->string('ventilation', 200)->nullable(); // Ej: "25 m³/h o 50 m³/h"
            $table->string('humidity', 200)->nullable(); // Ej: "No controlada"
            $table->string('atmosphere', 200)->nullable(); // Ej: "Aire natural"
            $table->text('usage'); // Ej: "Carga general refrigerada..."
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reefer_conditions');
    }
};
