import React from 'react';
import ReactDOM from 'react-dom';
import './index.css';
import * as serviceWorker from './serviceWorker';
import { BrowserRouter, Switch, Route } from 'react-router-dom';

import NavBar from "./NavBar";
import Calibracao from './Calibracao';
import Equipamento from './Equipamento';
import Padrao from './Padrao';
import TipoEquipamento from './TipoEquipamento';
import Unidade from './Unidade';
import Erro404 from './Erro404';

const paginasComNavBar = () => (
    <div>
        <NavBar />
        <Route path="/Equipamento" exact={true} component={Equipamento} />
        <Route path="/Padrao" exact={true} component={Padrao} />
        <Route path="/TipoEquipamento" exact={true} component={TipoEquipamento} />
        <Route path="/Unidade" exact={true} component={Unidade} />
        <Route path='*' component={Erro404} />
    </div>
)

ReactDOM.render(
    <BrowserRouter>
        <Switch>
            <Route path="/Calibracao/:equipamentoId" exact={true} component={Calibracao} />
            <Route component={paginasComNavBar} />
        </Switch>
    </BrowserRouter>
    , document.getElementById('root'));

// If you want your app to work offline and load faster, you can change
// unregister() to register() below. Note this comes with some pitfalls.
// Learn more about service workers: https://bit.ly/CRA-PWA
serviceWorker.unregister();
