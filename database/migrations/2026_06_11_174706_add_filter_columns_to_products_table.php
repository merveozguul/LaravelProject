<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $blueprint) {
            // Ürünlerin filtrelerde kullanılabilmesi için yeni alanlar ekliyoruz
            $blueprint->string('brand')->nullable()->after('name'); // Marka
            $blueprint->string('color')->nullable()->after('description'); // Renk
            $blueprint->string('size')->nullable()->after('color'); // Beden/Boyut

            // Sıralama motorunun (en çok satan, favori vb.) besleneceği istatistik alanları
            $blueprint->integer('sales_count')->default(0)->after('stock');
            $blueprint->integer('fav_count')->default(0)->after('sales_count');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $blueprint) {
            $blueprint->dropColumn(['brand', 'color', 'size', 'sales_count', 'fav_count']);
        });
    }
};
