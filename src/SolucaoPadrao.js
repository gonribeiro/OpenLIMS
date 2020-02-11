import React from 'react';
import axios from 'axios';
import MaterialTable from 'material-table';

class SolucaoPadrao extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            data: [],
            //unidades: [],
            columns: [
                { title: 'Id', field: 'id', editable: 'never' },
                { title: 'Nome', field: 'nome' },
                { title: 'Volume', field: 'volume' },
                {
                    title: 'Unidade',
                    field: 'unidade.un',
                    //lookup: { 1: 'L', 2: 'ml', 3: 'uL' },
                },
                { title: 'Entrada', field: 'entrada', type: 'date' },
                { title: 'Validade', field: 'validade', type: 'date' },
            ],
        }
    }

    componentDidMount(){
        this.carregarSolucoes();
        //this.listarUnidades();
    }

    carregarSolucoes = () => {
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

    /**
     * TODO: Resolver problemas com select de unidade com o data-table
     */
    /*listarUnidades = () => {
        axios.get('https://localhost:44302/api/Unidade')
        .then(response => {
            let unidades = response.data;
            this.setState({
                unidades: unidades
            })
        }).catch(error => {
            console.log(error);
        });
    }*/

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
            console.log(reponse);
            this.carregarSolucoes();
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
            unidadeId: parseInt(item.unidadeId), //TODO: erro com unidade
            entrada: item.entrada,
            validade: item.validade
        })
        .then(reponse => {
            this.carregarSolucoes();
        }).catch(error => {
            console.log(error);
        });
    }
    
    apagar = (item) => {
        axios.delete('https://localhost:44302/api/SolucaoPadroes/'+item)
        .then(response => {
            this.carregarSolucoes();
        }).catch(error => {
            console.log(error);
        });
    }
  
    render() {
        return (
            <MaterialTable
                title="Soluções e Reagentes"
                columns={this.state.columns}
                data={this.state.data}
                options={{
                    filtering: true,
                    exportButton: true,
                    search: false,
                    pageSize: 10,
                    pageSizeOptions: [10, 20, 30, 50, 100],
                    padding: 'dense',
                    addRowPosition: 'first'
                }}
                localization={{
                    header: {
                        actions: 'Ações'
                    },
                    body: {
                        emptyDataSourceMessage: 'Nenhum registro encontrado',
                        addTooltip: 'Adicionar',
                        deleteTooltip: 'Apagar', 
                        editTooltip: 'Editar',
                        editRow: {
                            deleteText: 'Tem certeza que deseja apagar?',
                            cancelTooltip: 'Cancelar',
                            saveTooltip: 'Salvar'
                      },
                    },
                    toolbar: {
                      exportTitle: 'Exportar'
                    },
                    pagination: {
                        labelRowsSelect: 'linhas',
                        firstTooltip: 'primeiro',
                        previousTooltip: 'anterior',
                        nextTooltip: 'próximo',
                        lastTooltip: 'último'
                    }
                }}
                unidades={this.state.unidades}
                editable={{
                onRowAdd: newData =>
                    new Promise((resolve, reject) => {
                        setTimeout(() => {
                            {
                            /**
                             * TODO: Escrever método de criação
                             */
                            console.log(newData);
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

export default SolucaoPadrao;