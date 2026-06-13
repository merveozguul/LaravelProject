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
        Schema::table('orders', function (Blueprint $table) {
            // Sadece tablonuzda eksik olan ve hata veren sütunları ekliyoruz
            if (!Schema::hasColumn('orders', 'name')) {
                $table->string('name')->after('user_id');
            }
            if (!Schema::hasColumn('orders', 'email')) {
                $table->string('email')->after('name');
            }
            if (!Schema::hasColumn('orders', 'phone')) {
                $table->string('phone')->nullable()->after('email');
            }
            if (!Schema::hasColumn('orders', 'address')) {
                $table->text('address')->after('phone');
            }
            if (!Schema::hasColumn('orders', 'city')) {
                $table->string('city')->nullable()->after('address');
            }
            if (!Schema::hasColumn('orders', 'country')) {
                $table->string('country')->nullable()->after('city');
            }
            if (!Schema::hasColumn('orders', 'zip_code')) {
                $table->string('zip_code')->nullable()->after('country');
            }
            if (!Schema::hasColumn('orders', 'subtotal')) {
                $table->decimal('subtotal', 10, 2)->default(0)->after('zip_code');
            }
            if (!Schema::hasColumn('orders', 'shipping_price')) {
                $table->decimal('shipping_price', 10, 2)->default(0)->after('subtotal');
            }
            if (!Schema::hasColumn('orders', 'total')) {
                $table->decimal('total', 10, 2)->default(0)->after('shipping_price');
            }
            if (!Schema::hasColumn('orders', 'shipping_method')) {
                $table->string('shipping_method')->default('Free Shipping')->after('total');
            }
            if (!Schema::hasColumn('orders', 'payment_method')) {
                $table->string('payment_method')->default('Cash / Bank Transfer')->after('shipping_method');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Geri sarma durumunda eklenen sütunları kaldırır
            $table->dropColumn([
                'name', 'email', 'phone', 'address', 'city', 'country',
                'zip_code', 'subtotal', 'shipping_price', 'total',
                'shipping_method', 'payment_method'
            ]);
        });
    }
};
