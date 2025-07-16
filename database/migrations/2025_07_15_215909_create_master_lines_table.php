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
        Schema::create('shipping_lines', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique();
            $table->string('name', 200);
            $table->timestamps();
        });

        Schema::create('vessels', function (Blueprint $table) {
            $table->id();
            $table->string('imo_number', 15)->unique();
            $table->string('name', 200);
            $table->enum('type', ['container', 'bulk', 'tanker', 'other'])->default('container');
            $table->foreignId('shipping_line_id')
                ->constrained('shipping_lines')
                ->references('id')
                ->onDelete('cascade');
            $table->Integer('pallets')->nullable();
            $table->timestamps();
        });

        Schema::create('ports', function (Blueprint $table) {
            $table->id();
            $table->string('code', 5)->unique();
            $table->string('name', 200);
            $table->string('country_code', 3);
            $table->geometry('location')->nullable(); // Optional, for geographical coordinates
            $table->timestamps();
        });

        Schema::create('container_types', function (Blueprint $table) {
            $table->id();
            $table->string('iso_code', 4)->unique();
            $table->string('description', 100);
            $table->decimal('length', 8, 2)->nullable(); // Length in meters
            $table->decimal('width', 8, 2)->nullable(); // Width in meters
            $table->decimal('height', 8, 2)->nullable(); // Height in meters
            $table->timestamps();
        });

        Schema::create('reefer_technologies', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->unique();
            $table->string('name', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_lines');
        Schema::dropIfExists('vessels');
        Schema::dropIfExists('ports');
        Schema::dropIfExists('container_types');
        Schema::dropIfExists('reefer_technologies');
    }
};
