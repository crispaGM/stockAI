import React from 'react';
import { Link } from 'react-router-dom';

import './styles.css';

import Logo from '../../assets/logo.jpg';

export default function Welcome () {
    return (
        <div id="box">
            <div className="container-welcome">
                <h1>SEJA</h1>
                <h1>BEM-VINDO</h1>
                <img src={Logo} alt="" />
                <h2>O StockAI foi criado para ajudar você a controlar seu estoque, da melhor forma possível.</h2>
                <Link className='regMarget' to='register-market'>
                    Cadastre seu estabelecimento
                </Link>
            </div>
        </div>
    );
}