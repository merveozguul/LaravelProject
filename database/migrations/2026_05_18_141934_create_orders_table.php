<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // 🌟 1. Kullanıcı İlişkisi (Hocanın istediği gibi: Üye silinse de sipariş kaydı silinmesin)
            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');

            // 🌟 2. Müşteri İletişim ve Teslimat Bilgileri
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->text('address');
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('zip_code')->nullable();

            // 🌟 3. Finansal Detaylar (Hocanın Controller kodunda toplama eklediği alanlar)
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('shipping_price', 10, 2)->default(0);
            $table->decimal('total', 10, 2)->default(0); // Sütun adını hocanın kodundaki gibi 'total' yaptık!

            // 🌟 4. Kargo ve Ödeme Tercihleri
            $table->string('shipping_method')->default('Free Shipping');
            $table->string('payment_method')->default('Cash / Bank Transfer');

            // 🌟 5. Sipariş Durum Yönetimi (Hocanın Enum yapısının birebir aynısı)
            $table->enum('status', [
                'New',
                'Accepted',
                'Cancelled',
                'Onshipping',
                'Completed'
            ])->default('New'); // Varsayılan durum artık İngilizce 'New'

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
