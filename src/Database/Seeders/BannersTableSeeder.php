<?php

namespace Brediweb\BrediBanner\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Brediweb\BrediDashboard\Models\CategoriaTransacao;
use Brediweb\BrediDashboard\Models\Transacao;

class BannersTableSeeder extends Seeder
{
    /**
     * 
     * Para rodar após instalar o pacote: 
     * php artisan db:seed --class=Bredi\\BrediBanner\\Database\\Seeders\\BannersTableSeeder
     * 
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        
        $categoriaTransacao = [
            'nome' => 'Gerenciar Banners'
        ];

        $transacaos = [
            [    
                // 'categoria_transacao_id' -> pegar do registro acima
                'permissao' => 'controle.banner.index',
                'descricao' => 'Listar banners',
            ],
            [    
                // 'categoria_transacao_id' -> pegar do registro acima
                'permissao' => 'controle.banner.create',
                'descricao' => 'Cadastrar novo banner',
            ],
            [    
                // 'categoria_transacao_id' -> pegar do registro acima
                'permissao' => 'controle.banner.store',
                'descricao' => 'Salvar novo banner',
            ],
            [    
                // 'categoria_transacao_id' -> pegar do registro acima
                'permissao' => 'controle.banner.edit',
                'descricao' => 'Editar Banner',
            ],
            [    
                // 'categoria_transacao_id' -> pegar do registro acima
                'permissao' => 'controle.banner.update',
                'descricao' => 'Atualizar banner',
            ],
            [    
                // 'categoria_transacao_id' -> pegar do registro acima
                'permissao' => 'controle.banner.destroy',
                'descricao' => 'Excluir',
            ],
        ];

        $categoria = CategoriaTransacao::updateOrCreate([
                'nome' => $categoriaTransacao['nome']
            ], [
                'nome' => $categoriaTransacao['nome']
            ]);

        if (isset($categoria->id)) {
            $this->command->info($categoria->nome . ' Adicionado com sucesso!');
            
            foreach($transacaos as $transacao) {

                $t = Transacao::updateOrCreate([
                    'permissao' => $transacao['permissao'],
                ], [
                    'categoria_transacao_id' => $categoria->id,
                    'permissao' => $transacao['permissao'],
                    'descricao' => $transacao['descricao'],
                ]);

                $this->command->info($t->permissao . ' Adicionado com sucesso!');

            }

        }
        
    }
}
