import React from 'react';
import axios from 'axios';
import MaterialTable from 'material-table';

class demo extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            data: [],
            unidades: [],
            columns: [
                { title: 'Id', field: 'id', editable: 'never' },
                { title: 'Nome', field: 'nome' },
                { title: 'Volume', field: 'volume' },
                //{ title: 'Unidade', field: 'unidade.un' },
                {
                    title: 'Unidade',
                    field: 'unidade.un'
                },
                { title: 'Entrada', field: 'entrada', type: 'date' },
                { title: 'Validade', field: 'validade', type: 'date' },
            ],
        }
    }

    /**
     * 
     */
    componentDidMount(){
        this.listarSolucoes();
        this.listarUnidades();
    }

    listarSolucoes = () => {
        axios.get('https://localhost:44302/api/SolucaoPadroes')
        .then(response => {
            let data = response.data;
            this.setState({
                data: data
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
        }).catch(error => {
            console.log(error);
        });
    }

    atualizar = (event, item) => {
        //event.preventDefault();
        axios.put('https://localhost:44302/api/SolucaoPadroes/'+event, { 
            id: item.id,
            nome: item.nome,
            volume: parseInt(item.volume),
            unidadeId: parseInt(item.unidadeId),
            entrada: item.entrada,
            validade: item.validade
        })
        .then(reponse => {
            this.listarSolucoes();
        }).catch(error => {
            console.log(error);
        });
    }
    
    apagar = (item) => {
        axios.delete('https://localhost:44302/api/SolucaoPadroes/'+item)
        .then(response => {
            this.listarSolucoes();
        }).catch(error => {
            console.log(error);
        });
    }
  
    render() {
        /*const obj = this.state.unidades.reduce(function(acc, cur, i) {
            acc[cur.id] = cur.un;
            return acc;
        }, {});*/

        return (
        <MaterialTable
            title="Soluções e Reagentes"
            columns={this.state.columns}
            data={this.state.data}
            unidades={this.state.unidades}
            editable={{
            onRowAdd: newData =>
                new Promise((resolve, reject) => {
                    setTimeout(() => {
                        {
                        const data = this.state.data;
                        data.push(newData);
                        this.setState({ data }, () => resolve());
                        }
                        resolve()
                    }, 1000)
                }),
            onRowUpdate: (newData, oldData) =>
                new Promise((resolve, reject) => {
                    setTimeout(() => {
                        this.atualizar(newData.id, newData);
                        /*{
                        const data = this.state.data;
                        const index = data.indexOf(oldData);
                        data[index] = newData;
                        this.setState({ data }, () => resolve());
                        console.log(newData);
                        }*/
                        resolve()
                    }, 1000)
                }),
            onRowDelete: oldData =>
                new Promise((resolve, reject) => {
                    setTimeout(() => {
                        this.apagar(oldData.id);
                        resolve()
                    }, 1000)
                }),
            }}
        />
        )
    }
  }

  export default demo;