import React from 'react';

import {
    FiHome,
    FiTrendingUp,
    FiDollarSign,
    FiBarChart2
} from "react-icons/fi";

import Chart from "chart.js";

import { Col, Row } from 'react-bootstrap';

import { Line, Bar } from "react-chartjs-2";

import {
    chartOptions,
    parseOptions,
    chartExample1,
    chartExample2
} from "../../variables/charts";

import Header from '../Header';

import './styles.css';

export default class Home extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            activeNav: 1,
            chartExample1Data: "data1"
        };
        if (window.Chart) {
            parseOptions(Chart, chartOptions());
        }
    }
    toggleNavs = (e, index) => {
        e.preventDefault();
        this.setState({
            activeNav: index,
            chartExample1Data:
                this.state.chartExample1Data === "data1" ? "data2" : "data1"
        });
    };

    render () {
        return (
            <div className="home-panel">
                <Header />

                <span className='page'><FiHome /> <h2>Home</h2></span>

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

                <Row>
                    <Col sm={12} md={7}>
                        <div className="grafico">
                            <p>OVERVIEW</p>
                            <h3>Valor de Venda</h3>
                            <div className="chart-sales">
                                <Line
                                    data={chartExample1[this.state.chartExample1Data]}
                                    options={chartExample1.options}
                                    getDatasetAtEvent={e => console.log(e)}
                                />
                            </div>
                        </div>
                    </Col>

                    <Col sm={12} md={5}>
                        <div className="grafico1">
                            <p>PERFORMANCE</p>
                            <h3>Produtos Estragados</h3>
                            <div className="chart-loses">
                                <Bar
                                    data={chartExample2.data}
                                    options={chartExample2.options}
                                />
                            </div>
                        </div>
                    </Col>
                </Row>
            </div>
        );
    }
}