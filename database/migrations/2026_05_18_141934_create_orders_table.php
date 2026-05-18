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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // Siparişi veren kullanıcıyı users tablosuna bağlıyoruz
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Siparişin toplam tutarı
            $table->decimal('total_amount', 10, 2);
            // Sipariş durumu (Beklemede, Onaylandı, Kargolandı vb.)
            $table->string('status')->default('Beklemede');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
