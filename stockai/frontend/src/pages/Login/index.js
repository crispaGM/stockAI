import React, { useState } from 'react';
import { Link, useHistory } from 'react-router-dom';

import api from '../../services/api';
import './styles.css';

import logo from '../../assets/logo.jpg';

export default function Login () {
    const history = useHistory();
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');

    async function handleLogin (e) {
        e.preventDefault();

        const data = {
            email,
            password,
        };

        try {
            const response = await api.post('auth/login', data);

            console.log(response.data);

            localStorage.setItem('token', response.data.token);
            localStorage.setItem('userId', response.data.user.id);
            localStorage.setItem('name', response.data.user.name);
            localStorage.setItem('dominio', response.data.user.dominio);
            localStorage.setItem('nome_estabelecimento', response.data.user.nome_estabelecimento);

            console.log(localStorage.token);

            history.push('/home');
        } catch (error) {
            alert('Usuário ou senha incorretos, tente novamente');
        }
    }

    return (
        <section className="container-login">
            <div className="logo">
                <img src={logo} alt="" />
            </div>
            <form onSubmit={handleLogin}>
                <input
                    type="email"
                    value={email}
                    onChange={e => setEmail(e.target.value)}
                    placeholder="Email"
                    required
                />

                <input
                    type="password"
                    value={password}
                    onChange={e => setPassword(e.target.value)}
                    placeholder="Senha"
                    required
                />

                <button className="button-login" type="submit">Entrar</button>

                <Link className="back-link" to="/register">
                    Não possui cadastro? Clique aqui
                </Link>
            </form>
        </section>
    );
}