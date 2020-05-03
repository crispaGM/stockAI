import React from 'react';

import {
    FiPackage,
    FiTrendingUp,
    FiDollarSign,
    FiBarChart2
} from "react-icons/fi";

import Header from '../Header';

import './styles.css';

export default function Products () {
    return (
        <div className="products-panel">
            <Header />

            <span className='page'><FiPackage /> <h2>Produtos</h2></span>

            <div className="card-row">
                <div className="card">
                    <h5>PRODUTOS VENDIDOS</h5>
                    <h4>89</h4>
                    <h6><span>-1,48%</span>Desde último mês</h6>
                    <i>
                        <FiTrendingUp />
                    </i>
                </div>

                <div className="card">
                    <h5>VENDAS</h5>
                    <h4>R$ 300,00</h4>
                    <h6><span>+2.70%</span>Desde último mês</h6>
                    <i>
                        <FiDollarSign />
                    </i>
                </div>

                <div className="card">
                    <h5>PRODUTOS EM ESTOQUE</h5>
                    <h4>340</h4>
                    <h6><span>+40</span>Desde último mês</h6>
                    <i>
                        <FiBarChart2 />
                    </i>
                </div>
            </div>
        </div>
    );
}