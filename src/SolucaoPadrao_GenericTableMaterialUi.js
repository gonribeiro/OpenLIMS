import React from 'react';
import axios from 'axios';
import 'bootstrap/dist/css/bootstrap.min.css';
import { Link } from 'react-router-dom'
import Button from '@material-ui/core/Button';
import TextField from '@material-ui/core/TextField';
import Select from '@material-ui/core/Select';
import InputLabel from '@material-ui/core/InputLabel';
import Input from '@material-ui/core/Input';
import FormControl from '@material-ui/core/FormControl';
import MenuItem from '@material-ui/core/MenuItem';
import Table from '@material-ui/core/Table';
import TableBody from '@material-ui/core/TableBody';
import TableCell from '@material-ui/core/TableCell';
import TableContainer from '@material-ui/core/TableContainer';
import TableHead from '@material-ui/core/TableHead';
import TableRow from '@material-ui/core/TableRow';
import Paper from '@material-ui/core/Paper';


class SolucaoPadrao_GenericTableMaterialUi extends React.Component {    
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
    
    criar = (event) => {
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
        return (
            <div>
                <TableContainer component={Paper}>
                    <Table className='1' size="small" aria-label="a dense table">
                        <TableHead>
                            <TableRow>
                                <TableCell align="right">
                                    <TextField id="standard-basic" label="Nome" name="nome" onChange={this.handleChange} required/>
                                </TableCell>
                                <TableCell align="right">
                                    <TextField id="standard-basic" label="Volume" name="volume" onChange={this.handleChange} required/>
                                </TableCell>
                                <TableCell align="right">
                                    <FormControl>
                                        <InputLabel htmlFor="grouped-select">UN</InputLabel>
                                        <Select name="unidadeId" input={<Input id="grouped-select" />} onChange={this.handleChange} required>
                                            <MenuItem>Selecione</MenuItem>
                                            {this.state.unidades.map(row => (
                                                <MenuItem value={row.id} key={row.id}>{row.un}</MenuItem>
                                            ))}
                                        </Select>
                                    </FormControl>
                                </TableCell>
                                <TableCell align="right"></TableCell>
                                <TableCell align="right">
                                    <TextField
                                        id="date"
                                        label="Validade"
                                        type="date"
                                        name="validade" 
                                        InputLabelProps={{
                                            shrink: true,
                                        }}
                                        onChange={this.handleChange} 
                                        required
                                    />
                                </TableCell>
                                <TableCell align="right">
                                    <form onSubmit={this.criar}>
                                        <Button type="submit" size="large" variant="contained" color="primary">
                                            <i class="far fa-save"></i>
                                        </Button>
                                    </form>
                                </TableCell>
                            </TableRow>
                        </TableHead>
                    </Table>
                </TableContainer>
                <TableContainer component={Paper}>
                    <Table className='1' size="small" aria-label="a dense enhanced  table">
                        <TableHead>
                            <TableRow>
                                <TableCell align="right">Id</TableCell>
                                <TableCell align="right">Nome</TableCell>
                                <TableCell align="right">Volume</TableCell>
                                <TableCell align="right">UN</TableCell>
                                <TableCell align="right">Entrada</TableCell>
                                <TableCell align="right">Validade</TableCell>
                                <TableCell align="center">Ações</TableCell>
                            </TableRow>
                        </TableHead>
                        <TableBody>
                            {this.state.solucaopadroes.map(row => (
                                <TableRow key={row.id}>
                                    <TableCell align="right">{row.id}</TableCell>
                                    <TableCell align="right">{row.nome}</TableCell>
                                    <TableCell align="right">{row.volume}</TableCell>
                                    <TableCell align="right">{row.unidade.un}</TableCell>
                                    <TableCell align="right">{row.entrada.substr(0, 10)}</TableCell>
                                    <TableCell align="right">{row.validade.substr(0, 10)}</TableCell>
                                    <TableCell align="right">
                                        <Button onClick={e => this.apagar(e, row.id)} variant="contained" color="secondary">
                                            <i class="far fa-trash-alt"></i>
                                        </Button>
                                        <Link to="/">
                                            <Button variant="contained" color="primary"><i class="far fa-edit"></i></Button>
                                        </Link>
                                    </TableCell>
                                </TableRow>
                            ))}
                        </TableBody>
                    </Table>
                </TableContainer>
            </div>
        );
    }
}

export default SolucaoPadrao_GenericTableMaterialUi;