<?php

namespace App\Enums;

abstract class TipoOperacaoEnum
{
    const SOCIO                 = 'ASS';
    const RECEITA               = 'REC';
    const DESPESA               = 'DES';
    const TRANSFERENCIA_ENTRADA = 'TRE';
    const TRANSFERENCIA_SAIDA   = 'TRS';
}

