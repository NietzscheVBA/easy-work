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
                'name' => 'Ver dashboard',
                'slug' => 'view_dashboard',
                'description' => 'Prmite visualizar os gráficos e relatórios iniciais.'
            ],
            [
                'name' => 'Ver relatório',
                'slug' => 'view_report',
                'description' => 'Prmite visualizar os gráficos e relatórios iniciais.'
            ],
            [
                'name' => 'Ver relatório de obras',
                'slug' => 'view_build',
                'description' => 'Prmite visualizar os gráficos e relatórios iniciais.'
            ],
            [
                'name' => 'Imprimir relatório',
                'slug' => 'print_report',
                'description' => 'Prmite visualizar os gráficos e relatórios iniciais.'
            ],

            [
                'name' => 'Gerenciar cliente',
                'slug' => 'manage_client',
                'description' => 'Permite cadastrar, editar e remover funcionários (Nível 3).',
            ],
            [
                'name' => 'Cadastrar cliente',
                'slug' => 'create_client',
                'description' => 'Permite cadastrar novos produtos no sistema.',
            ],
            [
                'name' => 'Editar cliente',
                'slug' => 'edit_client',
                'description' => 'Permite cadastrar novos produtos no sistema.',
            ],
            [
                'name' => 'Excluir cliente',
                'slug' => 'delete_client',
                'description' => 'Permite cadastrar novos produtos no sistema.',
            ],
            [
                'name' => 'Gerenciar usuários',
                'slug' => 'manage_users',
                'description' => 'Permite cadastrar, editar e remover funcionários (Nível 3).',
            ],
            [
                'name' => 'Cadastrar produto',
                'slug' => 'create_products',
                'description' => 'Permite cadastrar novos produtos no sistema.',
            ],
            [
                'name' => 'Editar produto',
                'slug' => 'edit_products',
                'description' => 'Permite cadastrar novos produtos no sistema.',
            ],
            [
                'name' => 'Excluir produto',
                'slug' => 'delete_products',
                'description' => 'Permite cadastrar novos produtos no sistema.',
            ],
            [
                'name' => 'Ver produtos',
                'slug' => 'show_products',
                'description' => 'Permite cadastrar novos produtos no sistema.',
            ],
            [
                'name' => 'Ver financeiro',
                'slug' => 'view_financial',
                'description' => 'Permite acessar o módulo financeiro e fluxo de caixa.',
            ],
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(['name' => $permission['name']], $permission);
        }
    }
}
