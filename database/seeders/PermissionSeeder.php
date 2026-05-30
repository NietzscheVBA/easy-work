<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'name' => 'view-dashboard',
                'description' => 'Prmite visualizar os gráficos e relatórios iniciais.'
            ],
            [
                'name' => 'manage-users',
                'description' => 'Permite cadastrar, editar e remover funcionários (Nível 3).',
            ],
            [
                'name' => 'create-products',
                'description' => 'Permite cadastrar novos produtos no sistema.',
            ],
            [
                'name' => 'delete-products',
                'description' => 'Permite excluir produtos do sistema.',
            ],
            [
                'name' => 'view-financial',
                'description' => 'Permite acessar o módulo financeiro e fluxo de caixa.',
            ],
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(['name' => $permission['name']], $permission);
        }
    }
}
