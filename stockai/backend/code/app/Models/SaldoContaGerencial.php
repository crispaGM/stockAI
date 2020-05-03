<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaldoContaGerencial extends Model
{
    protected $table = 'fin_saldo_conta_gerencial';
    protected $primaryKey = 'saldo_conta_gerencial_id';
    public $timestamps = false;


    protected $fillable = [
        'conta_gerencial_id',
        'scg_data',
        'scg_regime_caixa',
        'scg_valor_entrada',
        'scg_valor_saida'
    ];

    public function contaGerencaial()
    {
        return $this->belongsTo(ContaGerencial::class, 'conta_gerencial_id');
    }

    public function atualizaSaldoContaGerencial($data)
    {
        $saldo = SaldoContaGerencial::where('conta_gerencial_id', $data['conta_gerencial_id'])
            ->where('scg_data', $data['scg_data'])
            ->where('scg_regime_caixa', $data['scg_regime_caixa'])->first();

        if (isset($saldo)) {
            $saldo['scg_valor_entrada'] += $data['scg_valor_entrada'];
            $saldo['scg_valor_saida']   += $data['scg_valor_saida'];
            $saldo->save();
        } else {
            SaldoContaGerencial::create($data);
        }
    }
}
