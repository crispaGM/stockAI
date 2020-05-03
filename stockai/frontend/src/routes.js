import React from 'react';
import { BrowserRouter, Route, Switch } from 'react-router-dom';

import Login from './pages/Login';
import Register from './pages/Register';
import Welcome from './pages/Welcome';
import RegisterMarket from './pages/RegisterMarket';
import Dashboard from './pages/Dashboard';

export default function Routes () {
    return (
        <BrowserRouter>
            <Switch>
                <Route path="/" exact component={Login} />
                <Route path="/register" component={Register} />
                <Route path="/welcome" component={Welcome} />
                <Route path="/register-market" component={RegisterMarket} />
                <Route path="/home" component={Dashboard} />
            </Switch>
        </BrowserRouter>
    );
}