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
        Schema::create('containers', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // Código del contenedor, tipo: PEXX1234567
            $table->string('iso_code')->nullable(); // Código ISO como 22G1, 45R1, etc.

            $table->foreignId('container_type_id')->nullable()->constrained()->nullOnDelete(); // Tipo (Dry, Reefer, etc.)
            $table->foreignId('port_id')->nullable()->constrained()->nullOnDelete(); // Puerto de procedencia

            $table->foreignId('reefer_technology_id')->nullable()->constrained()->nullOnDelete(); // si aplica tecnología refrigerada
            $table->foreignId('reefer_machine_id')->nullable()->constrained()->nullOnDelete(); // si aplica maquina refrigerada

            // Datos que se completan durante la primera inspección:
            $table->year('manufacture_year')->nullable(); // Año de fabricación
            $table->decimal('tare', 10, 2)->nullable(); // Tara en kg
            $table->decimal('payload', 10, 2)->nullable(); // Payload en kg

            // Relación polimórfica: descarga o devolución
            $table->unsignedBigInteger('origin_id')->nullable();
            $table->string('origin_type')->nullable();

            //Campos de status y estadia
            $table->string('condition_status')->nullable(); // 'BU', 'CU', 'AU', 'NU', etc.
            $table->string('status')->nullable(); // 'activo', 'liberado', 'retenido', etc.
            $table->dateTime('gate_in_at')->nullable();
            $table->dateTime('gate_out_at')->nullable();
            $table->dateTime('last_machine_inspection_at')->nullable();
            $table->boolean('is_operative')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('containers');
    }
};
