import React from 'react';
import ReactDOM from 'react-dom';
import './index.css';
import * as serviceWorker from './serviceWorker';
import { BrowserRouter, Switch, Route } from 'react-router-dom';
import SolucaoPadrao from './SolucaoPadrao';
import SolucaoPadrao_Table2Next from './SolucaoPadrao_Table2Next';
import SolucaoPadrao_GenericTableMaterialUi from './SolucaoPadrao_GenericTableMaterialUi';
import CadastroFap from './CadastroFap';
import App from './App';

ReactDOM.render(
    <BrowserRouter>
        <Switch>
            <Route path="/" exact={true} component={SolucaoPadrao} />
            <Route path="/SolucaoPadrao_Table2Next" component={SolucaoPadrao_Table2Next} />
            <Route path="/SolucaoPadrao_GenericTableMaterialUi" component={SolucaoPadrao_GenericTableMaterialUi} />
            <Route path="/CadastroFap" component={CadastroFap} />
            <Route path='*' component={App} />
        </Switch>
    </BrowserRouter>
    , document.getElementById('root'));

// If you want your app to work offline and load faster, you can change
// unregister() to register() below. Note this comes with some pitfalls.
// Learn more about service workers: https://bit.ly/CRA-PWA
serviceWorker.unregister();