import React from 'react';

import {
    FiSettings,
    FiTrendingUp,
    FiDollarSign,
    FiBarChart2
} from "react-icons/fi";

import Header from '../Header';

import './styles.css';

export default function Settings () {
    return (
        <div className="settings-panel">
            <Header />

            <span className="page"><FiSettings /><h2>Configurações</h2></span>
        </div>
    );
}