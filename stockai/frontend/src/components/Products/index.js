import React, { useState } from 'react';
import { Table, Row, Col, Modal, Button } from 'react-bootstrap';

import {
    FiPackage,
    FiTrash2,
    FiPlusCircle,
    FiSearch
} from "react-icons/fi";

import Header from '../Header';

import './styles.css';

function RegisterProductModal (props) {
    return (
        <Modal
            {...props}
            size="lg"
            aria-labelledby="contained-modal-title-vcenter"
            centered
        >
            <Modal.Header closeButton>
                <Modal.Title>
                    Cadastrar produto
                </Modal.Title>
            </Modal.Header>

            <Modal.Body>
                <h5>Informações sobre o produto</h5>

                <form>
                    <h6>Código</h6>
                    <input type="text" name="product-code" id="product-code" />

                    <h6>Nome</h6>
                    <input type="text" name="product-name" id="product-name" />

                    <h6>Quantidade</h6>
                    <input type="text" name="product-qtd" id="product-qtd" />

                    <h6>Valor unitário</h6>
                    <input type="text" name="product-buy-value" id="product-buy-value" />

                    <h6>Valor de venda</h6>
                    <input type="text" name="product-sale-value" id="product-sale-value" />

                    <h6>Data de validade</h6>
                    <input type="date" name="product-life" id="product-life" />
                </form>
            </Modal.Body>

            <Modal.Footer>
                <button onClick={() => { }}>Cadastrar</button>
            </Modal.Footer>
        </Modal>
    );
}

export default function Products () {
    const [modalShow, setModalShow] = useState(false);

    return (
        <div className="products-panel">
            <Header />

            <span className='page'><FiPackage /> <h2>Produtos</h2></span>

            <div className="product-box">
                <h4>Overview</h4>

                <h2>Meus Produtos</h2>

                <div className="search-add">
                    <Row>
                        <Col sm={12} md={6}>
                            <div className="search-input">
                                <input type="text" name="search-product" id="search-product" placeholder="Buscar produto" />
                                <FiSearch />
                            </div>
                        </Col>
                        <Col sm={12} md={6}>
                            <button onClick={() => setModalShow(true)}><FiPlusCircle /> Cadastrar produto</button>
                        </Col>
                    </Row>
                </div>

                <RegisterProductModal
                    show={modalShow}
                    onHide={() => setModalShow(false)}
                />

                <Table responsive>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Código</th>
                            <th>Nome</th>
                            <th>Quantidade</th>
                            <th>Valor Unitário</th>
                            <th>Valor Venda</th>
                            <th>Data de Validade</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Table cell</td>
                            <td>Molho de Tomate - Tarantella</td>
                            <td>Table cell</td>
                            <td>Table cell</td>
                            <td>Table cell</td>
                            <td>Table cell</td>
                            <td><FiTrash2 /></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Table cell</td>
                            <td>Molho de Tomate - Tarantella</td>
                            <td>Table cell</td>
                            <td>Table cell</td>
                            <td>Table cell</td>
                            <td>Table cell</td>
                            <td><FiTrash2 /></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Table cell</td>
                            <td>Molho de Tomate - Tarantella</td>
                            <td>Table cell</td>
                            <td>Table cell</td>
                            <td>Table cell</td>
                            <td>Table cell</td>
                            <td><FiTrash2 /></td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Table cell</td>
                            <td>Molho de Tomate - Tarantella</td>
                            <td>Table cell</td>
                            <td>Table cell</td>
                            <td>Table cell</td>
                            <td>Table cell</td>
                            <td><FiTrash2 /></td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Table cell</td>
                            <td>Molho de Tomate - Tarantella</td>
                            <td>Table cell</td>
                            <td>Table cell</td>
                            <td>Table cell</td>
                            <td>Table cell</td>
                            <td><FiTrash2 /></td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>Table cell</td>
                            <td>Molho de Tomate - Tarantella</td>
                            <td>Table cell</td>
                            <td>Table cell</td>
                            <td>Table cell</td>
                            <td>Table cell</td>
                            <td><FiTrash2 /></td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>Table cell</td>
                            <td>Molho de Tomate - Tarantella</td>
                            <td>Table cell</td>
                            <td>Table cell</td>
                            <td>Table cell</td>
                            <td>Table cell</td>
                            <td><FiTrash2 /></td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>Table cell</td>
                            <td>Molho de Tomate - Tarantella</td>
                            <td>Table cell</td>
                            <td>Table cell</td>
                            <td>Table cell</td>
                            <td>Table cell</td>
                            <td><FiTrash2 /></td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td>Table cell</td>
                            <td>Molho de Tomate - Tarantella</td>
                            <td>Table cell</td>
                            <td>Table cell</td>
                            <td>Table cell</td>
                            <td>Table cell</td>
                            <td><FiTrash2 /></td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>Table cell</td>
                            <td>Molho de Tomate - Tarantella</td>
                            <td>Table cell</td>
                            <td>Table cell</td>
                            <td>Table cell</td>
                            <td>Table cell</td>
                            <td><FiTrash2 /></td>
                        </tr>
                    </tbody>
                </Table>
            </div>
        </div>
    );
}