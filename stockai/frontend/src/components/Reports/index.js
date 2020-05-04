import React from 'react';

import {
    FiFileText
} from "react-icons/fi";

import Header from '../Header';

import './styles.css';

export default function Reports () {
    return (
        <div className="reports-panel">
            <Header />

            <span className="page"><FiFileText /><h2>Relatórios</h2></span>
        </div>
    );
}