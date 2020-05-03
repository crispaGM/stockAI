import React from 'react';

import { FiHome, FiPackage, FiFileText, FiUser, FiSettings, FiMenu, FiSearch, FiBell, FiHelpCircle, FiTrendingUp, FiDollarSign, FiBarChart2 } from "react-icons/fi";

import './styles.css';
import { Link } from 'react-router-dom';

export default function Dashboard () {
    return (
        <div className="container-dashboard">
            <div className="sidebar">
                <div className='title'>
                    <span>Bastos Laticínios</span> <FiMenu />
                </div>
                <ul>
                    <li>
                        <Link>
                            <FiHome /> <span>Home</span>
                        </Link>
                    </li>

                    <li>
                        <Link>
                            <FiPackage /> <span>Produtos</span>
                        </Link>
                    </li>

                    <li>
                        <Link>
                            <FiFileText /> <span>Relatórios</span>
                        </Link>
                    </li>

                    <li>
                        <Link>
                            <FiUser /> <span>Perfil</span>
                        </Link>
                    </li>

                    <li>
                        <Link>
                            <FiSettings /> <span>Configurações</span>
                        </Link>
                    </li>
                </ul>
            </div>

            <div className="panel">
                <div className="top-row">
                    <div className="search-input">
                        <input type="text" name="search" id="search" placeholder="Buscar" />
                        <span><FiSearch /></span>
                    </div>

                    <div className="options">
                        <i>
                            <FiBell />
                        </i>

                        <i>
                            <FiHelpCircle />
                        </i>

                        <div className="session-user">
                            <i>
                                <FiUser />
                            </i>
                            Luis Carlos
                        </div>
                    </div>
                </div>

                <h2>Home</h2>

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
        </div>
    );
}