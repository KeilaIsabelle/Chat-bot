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
        Schema::create('attachments', function (Blueprint $table) {
            $table->string("protocol");
            $table->string("URL");
            $table->integer("type");
            $table->timestamps();

            $table->foreign('protocol')
              ->references('protocol')
              ->on('requests');
            $table->foreign('type')
              ->references('id')
              ->on('attachment_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attachments');
    }
};
