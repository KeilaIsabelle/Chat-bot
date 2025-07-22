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
    Schema::table('users', function (Blueprint $table) {
      $table->string('cpf')->unique();
      $table->string('phone')->nullable();
      $table->date('birthday')->nullable();
      $table->enum('user_type', ['student', 'staff']);
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('users', function (Blueprint $table) {
      $table->dropColumn(['cpf', 'birthday', 'phone', 'user_type']);
    });
  }
};
