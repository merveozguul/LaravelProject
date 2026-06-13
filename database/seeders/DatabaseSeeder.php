<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 🌟 HER SEFERİNDE OTOMATİK OLUŞACAK SABİT ADMİN HESABI
        $admin = \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@merveshop.com',
            'password' => \Illuminate\Support\Facades\Hash::make('12345678'),
        ]);

        // Rol yapını sisteme güvenlice bağlıyoruz
        $adminRole = \App\Models\Role::where('name', 'admin')->first() ?? \App\Models\Role::create(['name' => 'admin']);
        $admin->roles()->attach($adminRole);

        // Peşine de bizim o meşhur 50 ürünü üreten fabrikayı tetikliyoruz
        \App\Models\Product::factory()->count(50)->create();
    }
}
