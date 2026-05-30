<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'trabalhovba@gmail.com'],
            [
                'name' => 'CEO of application',
                'password' => Hash::make('654321'),
                'role_level' => 'super-admin',
                'tenant_id' => null,
                'role_id' => null,
            ]
        );
    }
}
