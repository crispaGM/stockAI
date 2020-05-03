import React, { useState } from 'react';
import { Link, useHistory } from 'react-router-dom';

import { FiArrowLeft } from "react-icons/fi";

import api from '../../services/api';
import './styles.css';

export default function Register () {
    const history = useHistory();

    function back () {
        history.goBack()
    }

    return (
        <section className="container-register">
            <Link className="back-link">
                <FiArrowLeft onClick={() => back()} />
            </Link>

            <h2>Crie uma conta</h2>
            <h4>Precisamos de alguma informações para liberar seu acesso à nossa aplicação</h4>

            <form action={() => { }}>
                <h5>Nome Completo</h5>
                <input type="text" name="name" id="name" />

                <h5>Email</h5>
                <input type="email" name="email" id="email" />

                <h5>Senha</h5>
                <input type="password" name="password" id="password" />

                <p>Informações pessoais</p>

                <h5>Data de Nascimento</h5>
                <input type="date" name="birthday" id="birthday" />

                <h5>CPF</h5>
                <input type="text" name="cpf" id="cpf" />

                <h5>Estado</h5>
                <input type="text" name="uf" id="uf" />

                <h5>Cidade</h5>
                <input type="text" name="city" id="city" />

                <h5>Telefone</h5>
                <input type="text" name="phone" id="phone" />

                <button className="button-register" type="submit">Continuar</button>
            </form>
        </section>
    );
}