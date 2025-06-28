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
        Schema::create('requerimentos', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->string('matricula');
            $table->text('observacoes')->nullable();
            $table->unsignedBigInteger('protocolo')->unique();
            $table->date('data_atual');
            $table->foreignId('tipo_req')->constrained('tipos_reqs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
