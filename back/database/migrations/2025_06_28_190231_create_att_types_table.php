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
       Schema::create('attachment_type', function (Blueprint $table) {
           $table->id();
           $table->string("name");
           $table->unsignedBigInteger("req_type");  // ALTERADO para unsignedBigInteger
           $table->timestamps();

           $table->foreign('req_type')
                 ->references('id')
                 ->on('request_type');
       });
   }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attachment_type');
    }
};
