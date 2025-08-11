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
        Schema::create('dischargues', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shipping_line_id')
                ->constrained('shipping_lines')
                ->onUpdate('cascade')
                ->onDelete('no action');

            $table->foreignId('vessel_id')
                ->constrained('vessels')
                ->onUpdate('no action')
                ->onDelete('no action');

            $table->string('voyague', 50)->nullable();
            $table->string('bl_number', 50)->nullable();
            $table->date('eta_date');
            $table->string('week', 50)->nullable();
            $table->dateTime('started_at')->nullable();
            $table->dateTime('completed_at')->nullable();

            $table->foreignId('user_id')
                ->constrained('users')
                ->onUpdate('no action')
                ->onDelete('no action');

            $table->foreignId('branch_id')
                ->constrained('branches')
                ->onUpdate('cascade')
                ->onDelete('no action');

            $table->foreignId('anulated_by')
                ->nullable()
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('devolutions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shipping_line_id')
                ->constrained('shipping_lines')
                ->onUpdate('cascade')
                ->onDelete('no action');

            $table->foreignId('vessel_id')
                ->constrained('vessels')
                ->onUpdate('no action')
                ->onDelete('no action');


            $table->foreignId('client_id') // nuevo campo
                ->constrained('clients')
                ->onUpdate('cascade')
                ->onDelete('no action');

            $table->string('voyague', 50)->nullable();
            $table->string('bl_number', 50)->nullable();
            $table->date('eta_date');
            $table->string('week', 50)->nullable();
            $table->dateTime('started_at')->nullable();
            $table->dateTime('completed_at')->nullable();

            $table->foreignId('user_id')
                ->constrained('users')
                ->onUpdate('no action')
                ->onDelete('no action');

            $table->foreignId('branch_id')
                ->constrained('branches')
                ->onUpdate('cascade')
                ->onDelete('no action');
            $table->foreignId('anulated_by')
                ->nullable()
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('devolutions');
        Schema::dropIfExists('dischargues');
    }
};
