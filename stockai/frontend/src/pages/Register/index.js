import React, { useState } from 'react';
import { Link, useHistory } from 'react-router-dom';

import api from '../../services/api';
import './styles.css';

export default function Register () {
    return (
        <div id="box">
            <section className="container-register">
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
                </form>
            </section>
        </div>
    );
}