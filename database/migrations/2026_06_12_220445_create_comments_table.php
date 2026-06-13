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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('subject')->nullable(); // Yorum başlığı
            $table->text('review'); // Yorum içeriği
            $table->integer('rate')->default(5); // 1-5 arası yıldız puanı
            $table->string('ip', 45)->nullable(); // Güvenlik için IP adresi
            $table->string('status', 20)->default('False'); // False, True veya Pending
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
