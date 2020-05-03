import React, { useState } from 'react';
import { Link, useHistory } from 'react-router-dom';

import api from '../../services/api';
import './styles.css';

import logo from '../../assets/logo.jpg';

export default function Login () {
    return (
        <section className="container-login">
            <div className="logo">
                <img src={logo} alt="" />
            </div>
            <form onSubmit={() => { }}>
                <input
                    type="email"
                    // value={id}
                    // onChange={e => setId(e.target.value)}
                    placeholder="Email"
                />

                <input
                    type="password"
                    // value={id}
                    // onChange={e => setId(e.target.value)}
                    placeholder="Senha"
                />

                <button className="button-login" type="submit">Entrar</button>

                <Link className="back-link" to="/register">
                    Não possui cadastro? Clique aqui
                    </Link>
            </form>
        </section>
    );
}