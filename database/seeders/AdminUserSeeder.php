<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {

        $adminRole = Role::firstOrCreate(['name' => 'admin', 'description' => 'Administrator role']);
        $customerRole = Role::firstOrCreate(['name' => 'customer', 'description' => 'Regular customer role']);

        $adminUser = User::firstOrCreate(
            ['email' => 'admin@mysite.com'], // Giriş e-postam
            [
                'name' => 'Admin User',
                'password' => Hash::make('12345678'), // Giriş şifrem: 12345678
            ]
        );

        $adminUser->roles()->syncWithoutDetaching([$adminRole->id]);
    }
}
