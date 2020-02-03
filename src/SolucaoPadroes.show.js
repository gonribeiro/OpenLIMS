import React from 'react';
import axios from 'axios';
import 'bootstrap/dist/css/bootstrap.min.css';
import { Link } from 'react-router-dom'
import { Button } from '@material-ui/core';

class SolucaoPadroes extends React.Component {    
    constructor(props) {
        super(props);

        this.state = {
            solucaopadroes: [],
            value: '',
            aaa: '',
            bbb: '',
            ccc: ''
        };

        this.handleChange = this.handleChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
        this.test = this.test.bind(this);
    }

    componentDidMount(){
        this.listar();
    }

    listar = () => {
        axios.get('https://localhost:44302/api/SolucaoPadroes')
        .then(response => {
            let solucaopadroes = response.data;
            this.setState({
                solucaopadroes: solucaopadroes.reverse()
            })
        }).catch(error => {
            console.log(error);
        });
    }
    
    apagar = (e, item) => {
        // item.preventDefault();
        axios.delete('https://localhost:44302/api/SolucaoPadroes/'+item)
        .then(response => {
            this.listar();
        }).catch(error => {
            console.log(error);
        });
    }

    handleChange(event) {
        this.setState({value: event.target.value});
    }
    
    handleSubmit(event) {
        const form = {
            nome: this.state.value,
            validade: ''
        }
        console.log(form);
        alert('Um nome foi enviado: ' + this.state.value);
        event.preventDefault();
    }

    test(event){
        const { target } = event
        const { name } = target
        const { value } = target['type'] === 'checkbox' ? target.checked : target.value
        return this.setState({
            [name]: event.target.value
        })
    }

    render(){        
        console.log(this.state);
        const tabela = this.state.solucaopadroes.map((item) => {
            return (
                <tr key={item.id}>
                    <th scope="row">{item.id}</th>
                    <td>{item.nome}</td>
                    <td>{item.volume}</td>
                    <td>{item.unidade}</td>
                    <td>{item.create_at}</td>
                    <td>{item.validade}</td>
                    <td>
                        <Button onClick={e => this.apagar(e, item.id)} variant="contained" color="secondary">
                            <i class="far fa-trash-alt"></i>
                        </Button>
                        <Link to="/">
                            <Button variant="contained" color="primary"><i class="far fa-edit"></i></Button>
                        </Link>
                    </td>
                </tr> 
            );
        });

        return (
            <div>
                <input type="text" name="aaa" onChange={this.test}></input>
                <input type="text" name="bbb" onChange={this.test}></input>
                <input type="text" name="ccc" onChange={this.test}></input>
                <form onSubmit={this.handleSubmit}>
                    <label>
                        Nome:
                        <input type="text" value={this.state.value} onChange={this.handleChange} /> 
                    </label>
                    <input type="submit" value="Enviar" />
                </form>
                <form onSubmit={this.criar}>
                    <tr>
                        <td>
                            #
                        </td>
                        <td>
                            <input type="text" class="form-control form-control-sm" ></input>
                        </td>
                        <td>
                            <input type="text" class="form-control form-control-sm" ></input>
                        </td>
                        <td>
                            <input type="text" class="form-control form-control-sm" ></input>
                        </td>
                        <td>
                            <input type="text" class="form-control form-control-sm" ></input>
                        </td>
                        <td>
                            <input type="text" class="form-control form-control-sm" ></input>
                        </td>
                        <td>
                            <Button type="submit" variant="contained" color="secondary">
                                <i class="far fa-trash-alt"></i>
                            </Button>
                        </td>
                    </tr>
                </form>
                <table class="table table-sm table-striped table-hover table-dark">
                    <thead>
                        <tr>
                            <th scope="col">Código</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Volume</th>
                            <th scope="col">Unidade</th>
                            <th scope="col">Entrada</th>
                            <th scope="col">Validade</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        { tabela }
                    </tbody>
                </table>
            </div>
        );
    }
}

export default SolucaoPadroes;