import React from 'react';

import {
    FiUser
} from "react-icons/fi";

import Header from '../Header';

import './styles.css';

export default function Profile () {
    return (
        <div className="profile-panel">
            <Header />

            <span className="page"><FiUser /><h2>Perfil</h2></span>
        </div>
    );
}