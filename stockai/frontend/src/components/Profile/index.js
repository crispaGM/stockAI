import React from 'react';

import {
    FiUser
} from "react-icons/fi";

import { Col, Row } from 'react-bootstrap';

import Header from '../Header';

import Business from '../../assets/business.svg';
import './styles.css';

export default function Profile () {
    const name = localStorage.getItem('name');
    const nome_estabelecimento = localStorage.getItem('nome_estabelecimento');

    return (
        <div className="profile-panel">
            <Header />

            <span className="page"><FiUser /><h2>Perfil</h2></span>

            <Row>
                <Col sm={12} lg={7}>
                    <div className="user-info">
                        <div className="icon">
                            <FiUser />
                        </div>

                        <h3>{name}</h3>

                        <Row>
                            <Col sm={7}>
                                <div className="information">
                                    <h5>Nome Completo</h5>
                                    <h6>Luiz Carlos de Souza Bastos</h6>
                                </div>
                            </Col>

                            <Col sm={5}>
                                <div className="information">
                                    <h5>CPF</h5>
                                    <h6>450.777.565-00</h6>
                                </div>
                            </Col>

                            <Col sm={3}>
                                <div className="information">
                                    <h5>UF</h5>
                                    <h6>BA</h6>
                                </div>
                            </Col>

                            <Col sm={4}>
                                <div className="information">
                                    <h5>Cidade</h5>
                                    <h6>Feira de Santana</h6>
                                </div>
                            </Col>

                            <Col sm={5}>
                                <div className="information">
                                    <h5>Data de Nascimento</h5>
                                    <h6>09/10/1983</h6>
                                </div>
                            </Col>

                            <Col sm={7}>
                                <div className="information">
                                    <h5>Email</h5>
                                    <h6>luizcarlos83@gmail.com</h6>
                                </div>
                            </Col>

                            <Col sm={5}>
                                <div className="information">
                                    <h5>Telefone</h5>
                                    <h6>(75) 98365-7342</h6>
                                </div>
                            </Col>
                        </Row>
                    </div>
                </Col>

                <Col sm={12} lg={5}>
                    <div className="market-info">
                        <h6>SUA EMPRESA</h6>

                        <div className="icon">
                            <img src={Business} alt="" />
                        </div>

                        <h3>{nome_estabelecimento}</h3>

                        {/* <Row>
                            <Col sm={11}>
                                <div className="information">
                                    <h5>CNPJ</h5>
                                    <h6>10.671.240/0001-71</h6>
                                </div>
                            </Col>

                            <Col sm={1}></Col>

                            <Col sm={4}>
                                <div className="information">
                                    <h5>UF</h5>
                                    <h6>BA</h6>
                                </div>
                            </Col>

                            <Col sm={6}>
                                <div className="information">
                                    <h5>Cidade</h5>
                                    <h6>Feira de Santana</h6>
                                </div>
                            </Col>

                            <Col sm={2}></Col>

                            <Col sm={8}>
                                <div className="information">
                                    <h5>Telefone</h5>
                                    <h6>(75) 98365-7342</h6>
                                </div>
                            </Col>

                            <Col sm={4}></Col>
                        </Row> */}
                    </div>
                </Col>
            </Row>
        </div>
    );
}