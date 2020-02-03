import React from 'react';
import Axios from 'axios';
import 'bootstrap/dist/css/bootstrap.min.css';
import paginationFactory from 'react-bootstrap-table2-paginator';
import filterFactory, { textFilter } from 'react-bootstrap-table2-filter';
import 'react-bootstrap-table-next/dist/react-bootstrap-table2.min.css';
import BootstrapTable from 'react-bootstrap-table-next';
import { Link } from 'react-router-dom'
import { Button } from '@material-ui/core';

class SolucaoPadroes extends React.Component {    
    constructor(props) {
        super(props);

        this.state = {
            solucaopadroes: [],
            id: '',
            test: []
        };
    }

    componentDidMount(){
        Axios.get('https://localhost:44302/api/SolucaoPadroes')
        .then(response => {
            let solucaopadroes = response.data;
            this.setState({
                solucaopadroes: solucaopadroes
            })
        }).catch(error => {
            console.log(error);
        });

        /*var invocation = new XMLHttpRequest();
        var url = 'https://localhost:44359/api/SolucaoPadrao';   
            this.test = invocation.open('GET', url, true);
            console.log('teste', this.test);*/
            /*invocation.onreadystatechange = handler;
            invocation.send();*/
        
    }

    handleSubmit = (event) => {
        console.log('aqui');
        event.preventDefault();

        Axios.delete('https://localhost:44302/api/SolucaoPadroes/6')
            .then(response => {
                console.log(response);
            })
    }

    render(){
        /*const tabela = this.state.solucaopadroes.map((item) => {
            return (<p key={item.id}> {item.id} - {item.nome} - {item.validade} - {item.volume} - {item.unidade} - {item.create_at} - {item.delete_at} </p>);
        });*/
        
        function button(cell, row){
            return  <div> 
                        <Link to="/">
                            <Button variant="contained" color="primary"><i class="far fa-edit"></i></Button>
                        </Link>
                        <a href={ row.id }>
                            <Button variant="contained" color="secondary" aria-label="edit"><i class="far fa-trash-alt"></i></Button>
                        </a>
                        <form method="DELETE" action="https://localhost:44302/api/SolucaoPadroes/9" enctype="application/json; charset=utf-8">
                            <Button type="submit" variant="contained" color="secondary" aria-label="edit"><i class="far fa-trash-alt"></i></Button>
                        </form>
                        <form onClick={this.handleSubmit}>
                            <button type="submit">Delete</button>
                        </form>
                        <button type="submit" onClick={this.handleSubmit}>
                            Delete2
                        </button>
                    </div>
        }

        const columns = [{
            dataField: 'id',
            text: 'Código',
            filter: textFilter({
                placeholder: 'Placeholder'
            }),
            sort: true
        },{
            dataField: 'nome',
            text: 'Substância',
            filter: textFilter(),
            sort: true
        },{
            dataField: 'validade',
            text: 'Validade',
            filter: textFilter(),
            sort: true
        },{
            dataField: 'volume',
            text: 'Volume',
            sort: true
        },{
            dataField: 'unidade',
            text: 'Unidade',
            sort: true
        },{
            dataField: 'create_at',
            text: 'Entrada',
            filter: textFilter(),
            sort: true
        },{
            text: 'Ações',
            formatter: button
        }]

        const defaultSorted = [{
            dataField: 'id',
            order: 'asc'
        }];

        return (
            <div>
                <button type="submit" onClick={this.handleSubmit}>
                    Delete2
                </button>
                <BootstrapTable
                    keyField='id'
                    data={ this.state.solucaopadroes }
                    columns={ columns }
                    pagination={ paginationFactory() }
                    filter={ filterFactory() }
                    defaultSorted={ defaultSorted } 
                    bordered={ false }
                    striped
                    hover
                    condensed
                />
            </div>
        );
    }
}

export default SolucaoPadroes;