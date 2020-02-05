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
            unidades: [],
            nome: '',
            volume: '',
            unidadeId: '',
            validade: ''
        };

        this.handleChange = this.handleChange.bind(this);
        this.criar = this.criar.bind(this);
    }

    componentDidMount(){
        this.listarSolucoes();
        this.listarUnidades();
    }

    listarSolucoes = () => {
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

    listarUnidades = () => {
        axios.get('https://localhost:44302/api/Unidade')
        .then(response => {
            let unidades = response.data;
            this.setState({
                unidades: unidades
            })
        }).catch(error => {
            console.log(error);
        });
    }

    handleChange(event){
        const { target } = event
        const { name } = target
        return this.setState({
            [name]: event.target.value
        })
    }
    
    criar(event) {
        console.log(this.state.nome,
            this.state.volume,
            this.state.unidadeId,
            this.state.validade)
        event.preventDefault();
        axios.post('https://localhost:44302/api/SolucaoPadroes', { 
            nome: this.state.nome,
            volume: parseInt(this.state.volume),
            unidadeId: parseInt(this.state.unidadeId),
            entrada: new Date(),
            validade: this.state.validade
        })
        .then(reponse => {
            this.listarSolucoes();
            console.log(reponse);
        }).catch(error => {
            console.log(error);
        });
    }
    
    apagar = (e, item) => {
        axios.delete('https://localhost:44302/api/SolucaoPadroes/'+item)
        .then(response => {
            this.listarSolucoes();
            console.log(response);
        }).catch(error => {
            console.log(error);
        });
    }

    render(){
        const unidades = this.state.unidades.map((item) => {
            return (
                <option value={item.id} key={item.id}>{item.un}</option>
            );
        });
        
        const solucaopadroes = this.state.solucaopadroes.map((item) => {
            return (
                <tr key={item.id}>
                    <th scope="row">{item.id}</th>
                    <td>{item.nome}</td>
                    <td>{item.volume}</td>
                    <td>{item.unidade.un}</td>
                    <td>{item.entrada.substr(0, 10)}</td>
                    <td>{item.validade.substr(0, 10)}</td>
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
                <form onSubmit={this.criar}>
                    <tr>
                        <td>
                            <label>Nome</label>
                            <input type="text" name="nome" class="form-control form-control-sm" placeholder="Nome" onChange={this.handleChange}></input>
                        </td>
                        <td>
                            <label>Volume</label>
                            <input type="text" name="volume" class="form-control form-control-sm" placeholder="Volume" onChange={this.handleChange}></input>
                        </td>
                        <td>
                            <label>Unidade</label>
                            <select name="unidadeId" class="form-control form-control-sm" onChange={this.handleChange}>
                                {unidades}
                            </select>
                        </td>
                        <td>
                            <label>Validade</label>
                            <input type="date" name="validade" class="form-control form-control-sm" onChange={this.handleChange}></input>
                        </td>
                        <td>
                            <Button type="submit" variant="contained" color="secondary">
                                <i class="far fa-save"></i>
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
                        { solucaopadroes }
                    </tbody>
                </table>
            </div>
        );
    }
}

export default SolucaoPadroes;