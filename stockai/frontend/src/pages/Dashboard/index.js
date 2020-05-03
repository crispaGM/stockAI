import React from 'react';
import { Link } from 'react-router-dom';
import { Tab, Container, Col, Row, Nav, NavItem, NavLink } from 'react-bootstrap';

import { FiHome, FiPackage, FiFileText, FiUser, FiSettings, FiMenu, FiSearch, FiBell, FiHelpCircle, FiTrendingUp, FiDollarSign, FiBarChart2 } from "react-icons/fi";

import Home from '../../components/Home';
import Products from '../../components/Products';
import Reports from '../../components/Reports';
import Profile from '../../components/Profile';
import Settings from '../../components/Settings';

import './styles.css';

export default function Dashboard () {
    return (
        <div className="container-dashboard">
            <Tab.Container defaultActiveKey="home">
                <Nav variant="pills" className="flex-column">
                    <div className='title'>
                        <span>Bastos Laticínios</span> <FiMenu />
                    </div>
                    <Nav.Item>
                        <Nav.Link eventKey="home">
                            <FiHome /> <span>Home</span>
                        </Nav.Link>
                    </Nav.Item>
                    <Nav.Item>
                        <Nav.Link eventKey="products">
                            <FiPackage /> <span>Produtos</span>
                        </Nav.Link>
                    </Nav.Item>
                    <Nav.Item>
                        <Nav.Link eventKey='reports'>
                            <FiFileText /> <span>Relatórios</span>
                        </Nav.Link>
                    </Nav.Item>
                    <Nav.Item>
                        <Nav.Link eventKey="profile">
                            <FiUser /> <span>Perfil</span>
                        </Nav.Link>
                    </Nav.Item>
                    <Nav.Item>
                        <Nav.Link eventKey='settings'>
                            <FiSettings /> <span>Configurações</span>
                        </Nav.Link>
                    </Nav.Item>
                </Nav>

                <Tab.Content>
                    <Tab.Pane eventKey="home">
                        <Home />
                    </Tab.Pane>
                    <Tab.Pane eventKey="products">
                        <Products />
                    </Tab.Pane>
                    <Tab.Pane eventKey="reports">
                        <Reports />
                    </Tab.Pane>
                    <Tab.Pane eventKey="profile">
                        <Profile />
                    </Tab.Pane>
                    <Tab.Pane eventKey="settings">
                        <Settings />
                    </Tab.Pane>
                </Tab.Content>

            </Tab.Container>
        </div>
    );
}