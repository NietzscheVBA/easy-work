<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'email' => 'teste1@gmail.com',
                'name' => 'Construrota LTDA',
                'password' => Hash::make('654321'),
                'role_level' => 'super-tenant',
                'tenant_id' => null,
                'role_id' => null,
            ],
            [
                'email' => 'teste2@gmail.com',
                'name' => 'Marcos da silva',
                'password' => Hash::make('654321'),
                'role_level' => 'super-user',
                'tenant_id' => null,
                'role_id' => null,
            ],
            [
                'email' => 'teste3@gmail.com',
                'name' => 'CEO of application',
                'password' => Hash::make('654321'),
                'role_level' => 'super-admin',
                'tenant_id' => null,
                'role_id' => null,
            ]
        ];

        foreach ($users as $user) {
            User::updateOrCreate(['name' => $user['name']], $user);
        }
    }
}
