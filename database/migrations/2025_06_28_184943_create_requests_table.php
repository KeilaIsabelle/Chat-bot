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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->string('enrollments');
            $table->text('observations')->nullable();
            $table->string('protocol')->unique();
            $table->unsignedBigInteger('type');
            $table->timestamps();

            $table->foreign('type')
              ->references('id')
              ->on('request_type');
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
