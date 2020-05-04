import React from 'react';

import { useHistory } from 'react-router-dom';

import { Dropdown } from 'react-bootstrap';

import {
    FiUser,
    FiSearch,
    FiBell,
    FiHelpCircle,
} from "react-icons/fi";

import api from '../../services/api';

import './styles.css';

export default function Header () {
    const history = useHistory();

    async function handleLogout () {
        try {
            await api.get('auth/logout');

            localStorage.clear();

            history.push('/');
        } catch (error) {
            alert('Erro ao efetuar o logout');
        }
    }

    return (
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

                <Dropdown>
                    <Dropdown.Toggle className="session-user">
                        <i>
                            <FiUser />
                        </i>
                        <span>{localStorage.name}</span>
                    </Dropdown.Toggle>

                    <Dropdown.Menu>
                        <Dropdown.Item onClick={handleLogout} className='item'>Sair</Dropdown.Item>
                    </Dropdown.Menu>
                </Dropdown>
            </div>
        </div>
    );
}