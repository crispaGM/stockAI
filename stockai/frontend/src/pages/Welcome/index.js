import React from 'react';
import { Link, useHistory } from 'react-router-dom';

import { FiArrowLeft } from 'react-icons/fi';

import './styles.css';

import BemVindo from '../../assets/bem-vindo.jpg';

export default function Welcome () {
    const history = useHistory();

    function back () {
        history.goBack()
    }

    return (
        <div className="container-welcome">
            <Link className="back-link">
                <FiArrowLeft onClick={() => back()} />
            </Link>
            <h1>SEJA</h1>
            <h1>BEM-VINDO</h1>
            <img src={BemVindo} alt="" />
            <h2>O StockAI foi criado para ajudar você a controlar seu estoque, da melhor forma possível.</h2>
            <Link className='regMarget' to='register-market'>
                Cadastre seu estabelecimento
            </Link>
        </div>
    );
}