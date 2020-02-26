import React from 'react';
import axios from 'axios';
import MaterialTable from 'material-table';
import 'bootstrap/dist/css/bootstrap.min.css';

class SolucaoPadrao extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            data: [],
            unidades: {},
        }
    }

    componentDidMount(){
        this.carregarSolucoes();
        this.listarUnidades();
    }

    carregarSolucoes = () => {
        axios.get('http://localhost:53048/api/padrao')
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
    listarUnidades = () => {
        axios.get('http://localhost:53048/api/Unidade')
        .then(response => {
            // Formata o retorno da unidade para listar adequadamente no combobox do data-table
            // Pega somente as unidades e salva em array
            let unidades = response.data.map((item, key) =>
                item.un
            );
            // Formata array em string com indice de todas as unidades
            let unidadeFormatadaParaComboBox = unidades.reduce(function(acc, cur, i) {
                acc[i+1] = cur;
                return acc;
            }, {});
            this.setState({
                unidades: unidadeFormatadaParaComboBox
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
        axios.post('http://localhost:53048/api/padrao', { 
            nome: this.state.nome,
            volume: parseInt(this.state.volume),
            unidadeId: parseInt(this.state.unidadeId),
            entrada: new Date(),
            validade: this.state.validade
        })
        .then(reponse => {
            this.carregarSolucoes();
        }).catch(error => {
            alert('Erro: Não foi possível criar');
        });
    }

    atualizar = (event, item) => {
        //event.preventDefault();
        axios.put('http://localhost:53048/api/padrao/'+event, { 
            id: item.id,
            nome: item.nome,
            volume: parseInt(item.volume),
            unidadeId: parseInt(item.unidadeId),
            entrada: item.entrada,
            validade: item.validade
        })
        .then(reponse => {
            this.carregarSolucoes();
        }).catch(error => {
            alert('Erro: Não foi possível atualizar');
        });
    }
    
    apagar = (item) => {
        axios.delete('http://localhost:53048/api/padrao/'+item)
        .then(response => {
            this.carregarSolucoes();
        }).catch(error => {
            alert('Erro: Não foi possível apagar');
        });
    }

    
  
    render() {
        return (
            <MaterialTable
                title="Padrões"
                columns={[
                    { title: 'Id', field: 'id', editable: 'never' },
                    { title: 'Nome', field: 'nome' },
                    { title: 'Volume', field: 'volume' },
                    {
                        title: 'Unidade',
                        field: 'unidadeId',
                        lookup: this.state.unidades,
                    },
                    { title: 'Valor', field: 'valor' },
                    { title: 'Nota Fiscal', field: 'notaFiscal' },
                    { title: 'Entrada', field: 'create_at', type: 'date' },
                    { title: 'Validade', field: 'validade', type: 'date' },
                ]}
                data={this.state.data}
                options={{
                    filtering: true,
                    exportButton: true,
                    search: false,
                    pageSize: 50,
                    pageSizeOptions: [50, 500, 1000, 5000],
                    padding: 'dense',
                    addRowPosition: 'first',
                    rowStyle: rowData => ({
                        // backgroundColor: (rowData.tableData.id % 2 == 0) ? '#343a40' : '#3e444a',
                        // color: '#FFF'
                        backgroundColor: (rowData.tableData.id % 2 === 0) ? '#FFF' : '#CCC',
                    })
                }}
                /*onRowClick={(event, rowData) => {
                    //mouse hover //console.log(event, rowData);    
                }}*/
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