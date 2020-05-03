<?php

use App\Models\Permissions\Recurso;
use Illuminate\Database\Seeder;

class RecursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $recursos = [
            ['rec_nome' => 'role'],
            ['rec_nome' => 'cadastro_atletica'],
            ['rec_nome' => 'cadastro_categoria'],
            ['rec_nome' => 'cadastro_grupo_conta_gerencial'],
            ['rec_nome' => 'cadastro_conta_gerencial'],
            ['rec_nome' => 'cadastro_plano_associacao'],
            ['rec_nome' => 'cadastro_socio'],
            ['rec_nome' => 'cadastro_pagamento_associacao'],
            ['rec_nome' => 'cadastro_lancamento'],
            ['rec_nome' => 'cadastro_produto'],
            ['rec_nome' => 'cadastro_venda'],
            ['rec_nome' => 'perfil_unidade_negocio'],
        ];

        foreach ($recursos as $recurso) {
            Recurso::updateOrCreate(['rec_nome' => $recurso['rec_nome']], $recurso);
        }
    }
}
