import React, { useState } from 'react';
import { Link, useHistory } from 'react-router-dom';

import api from '../../services/api';
import './styles.css';

export default function RegisterMarket () {
    return (
        <div className="container-market">
            <div className="first">
                <h2>Conte-nos sobre seu négocio</h2>
                <h4>Estamos ansiosos para poder te auxiliar</h4>
            </div>

            <p>Informações do estabelecimento</p>

            <form action={() => { }}>
                <h5>Nome comercial</h5>
                <input type="text" name="market-name" id="market-name" />

                <h5>CNPJ (Opcional)</h5>
                <input type="text" name="cnpj" id="cnpj" />

                <h5>Logradouro</h5>
                <input type="text" name="street" id="street" />

                <h5>Bairro</h5>
                <input type="text" name="neighborhood" id="neighborhood" />

                <h5>CEP</h5>
                <input type="text" name="cep" id="cep" />

                <h5>Telefone</h5>
                <input type="text" name="market-phone" id="market-phone" />

                <button className="button-register-market" type="submit">Cadastrar</button>
            </form>
        </div>
    );
}