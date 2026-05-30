<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $messanges = [
            [
                'user_id' => 1,
                'message' => 'Prmite visualizar os gráficos e relatórios iniciais.'
            ],
            [
                'user_id' => 2,
                'message' => 'Permite cadastrar, editar e remover funcionários (Nível 3).',
            ],
            [
                'user_id' => 3,
                'message' => 'Permite cadastrar novos produtos no sistema.',
            ],
            [
                'user_id' => 1,
                'message' => 'Permite excluir produtos do sistema.',
            ],
            [
                'user_id' => 2,
                'message' => 'Permite acessar o módulo financeiro e fluxo de caixa.',
            ],
        ];

        foreach ($messanges as $messange) {
            Message::create($messange);
        }
    }
}
