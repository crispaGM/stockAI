import React from 'react';

import {
    FiUser,
    FiSearch,
    FiBell,
    FiHelpCircle,
} from "react-icons/fi";

import './styles.css';

export default function Header () {
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

                <div className="session-user">
                    <i>
                        <FiUser />
                    </i>
                    <span>Luis Carlos</span>
                </div>
            </div>
        </div>
    );
}