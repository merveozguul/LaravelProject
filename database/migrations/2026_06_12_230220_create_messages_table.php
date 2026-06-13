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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('email', 100);
            $table->string('phone', 20)->nullable();
            $table->string('subject', 200)->nullable();
            $table->text('message');
            $table->text('note')->nullable(); // Adminin mesaj altına alacağı özel notlar
            $table->string('ip', 45)->nullable(); // Güvenlik logu için
            $table->string('status', 20)->default('New'); // New, Read, Replied
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
