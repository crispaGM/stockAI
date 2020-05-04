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

    const [name, setName] = useState('');
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [password_confirmation, setPasswordConfirmation] = useState('');

    async function handleRegister (e) {
        e.preventDefault();

        const data = {
            name,
            email,
            password,
            password_confirmation,
        };

        try {
            const response = await api.post('auth/signup', data);

            console.log(response.data);

            history.push('/');
        } catch (error) {
            alert('Erro no cadastro, tente novamente');
        }
    }

    return (
        <section className="container-register">
            <Link className="back-link" to={''}>
                <FiArrowLeft onClick={() => back()} />
            </Link>

            <h2>Crie uma conta</h2>
            <h4>Precisamos de alguma informações para liberar seu acesso à nossa aplicação</h4>

            <form onSubmit={handleRegister}>
                <h5>Nome Completo</h5>
                <input
                    type="text"
                    value={name}
                    onChange={e => setName(e.target.value)}
                    required
                />

                <h5>Email</h5>
                <input
                    type="email"
                    value={email}
                    onChange={e => setEmail(e.target.value)}
                    required
                />

                <h5>Senha</h5>
                <input
                    type="password"
                    value={password}
                    onChange={e => setPassword(e.target.value)}
                    required
                />

                <h5>Confirmação de Senha</h5>
                <input
                    type="password"
                    value={password_confirmation}
                    onChange={e => setPasswordConfirmation(e.target.value)}
                    required
                />

                {/* <p>Informações pessoais</p>

                <h5>Data de Nascimento</h5>
                <input type="date" name="birthday" id="birthday" />

                <h5>CPF</h5>
                <input type="text" name="cpf" id="cpf" />

                <h5>Estado</h5>
                <input type="text" name="uf" id="uf" />

                <h5>Cidade</h5>
                <input type="text" name="city" id="city" />

                <h5>Telefone</h5>
                <input type="text" name="phone" id="phone" /> */}

                <button className="button-register" type="submit">Continuar</button>
            </form>
        </section>
    );
}