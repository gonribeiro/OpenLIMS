import React from 'react';
import axios from 'axios';
import MaterialTable from 'material-table';

class Solucao extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            data: [],
            unidades: {}, 
            padroes: {},
            solventes: {},
            equipamentos: {}
        }
    }

    componentDidMount(){
        this.listarSolucao();
        this.listarPadroes();
        this.listarSolventes();
        this.listarUnidades();
        this.listarEquipamentos();
    }

    listarSolucao = () => {
        axios.get('http://localhost:53048/api/solucao')
        .then(response => {
            let data = response.data;
            this.setState({
                data: data
            })
        }).catch(error => {
            console.log(error);
        });
    }

    listarPadroes = () => {
        axios.get('http://localhost:53048/api/Padrao')
        .then(response => {
            // Formata o retorno da unidade para listar adequadamente no combobox do data-table
            // Pega somente as unidades e salva em array
            let padroes = response.data.map((item, key) =>
                [item.id, item.nome]
            );
            // Formata array em string com indice de todas as unidades
            let padraoFormatadaParaComboBox = padroes.reduce(function(acc, cur, i) {
                acc[cur[0]] = cur[1];
                return acc;
            }, {});
            this.setState({
                padroes: padraoFormatadaParaComboBox
            })
        }).catch(error => {
            console.log(error);
        });
    }

    listarSolventes = () => {
        axios.get('http://localhost:53048/api/Solvente')
        .then(response => {
            // Formata o retorno da unidade para listar adequadamente no combobox do data-table
            // Pega somente as unidades e salva em array
            let solventes = response.data.map((item, key) =>
                [item.id, item.nome]
            );
            // Formata array em string com indice de todas as unidades
            let solventeFormatadaParaComboBox = solventes.reduce(function(acc, cur, i) {
                acc[cur[0]] = cur[1];
                return acc;
            }, {});
            this.setState({
                solventes: solventeFormatadaParaComboBox
            })
        }).catch(error => {
            console.log(error);
        });
    }

    listarEquipamentos = () => {
        axios.get('http://localhost:53048/api/Equipamento')
        .then(response => {
            // Formata o retorno da unidade para listar adequadamente no combobox do data-table
            // Pega somente as unidades e salva em array
            let equipamentos = response.data.map((item, key) =>
                [item.id, item.nome]
            );
            // Formata array em string com indice de todas as unidades
            let equipamentoFormatadaParaComboBox = equipamentos.reduce(function(acc, cur, i) {
                acc[cur[0]] = cur[1];
                return acc;
            }, {});
            this.setState({
                equipamentos: equipamentoFormatadaParaComboBox
            })
        }).catch(error => {
            console.log(error);
        });
    }
    
    listarUnidades = () => {
        axios.get('http://localhost:53048/api/Unidade')
        .then(response => {
            // Formata o retorno da unidade para listar adequadamente no combobox do data-table
            // Pega somente as unidades e salva em array
            let unidades = response.data.map((item, key) =>
                [item.id, item.un]
            );
            // Formata array em string com indice de todas as unidades
            let unidadeFormatadaParaComboBox = unidades.reduce(function(acc, cur, i) {
                acc[cur[0]] = cur[1];
                return acc;
            }, {});
            this.setState({
                unidades: unidadeFormatadaParaComboBox
            })
        }).catch(error => {
            console.log(error);
        });
    }
    
    criar = (item) => {
        axios.post('http://localhost:53048/api/solucao', {
            padraoId: parseInt(item.padraoId),
            solventeId: parseInt(item.solventeId),
            equipamentoId: parseInt(item.equipamentoId),
            volume: parseInt(item.volume),
            unidadeId: parseInt(item.unidadeId),
            create_at: new Date(),
            validade: new Date()
        })
        .then(reponse => {
            this.listarSolucao();
        }).catch(error => {
            console.log(error);
            alert('Erro: Não foi possível criar');
        });
    }

    atualizar = (event, item) => {
        axios.put('http://localhost:53048/api/solucao/'+event, { 
            id: item.id,
            nome: item.nome,
            volume: parseInt(item.volume),
            unidadeId: parseInt(item.unidadeId),            
            valor: item.valor,
            notaFiscal: item.notaFiscal,
            validade: item.validade
        })
        .then(reponse => {
            this.listarSolucao();
        }).catch(error => {
            alert('Erro: Não foi possível atualizar');
        });
    }
    
    apagar = (item) => {
        axios.delete('http://localhost:53048/api/solucao/'+item)
        .then(response => {
            this.listarSolucao();
        }).catch(error => {
            alert('Erro: Não foi possível apagar');
        });
    }
  
    render() {
        return (
            <div>
                <MaterialTable
                    title="Soluções"
                    columns={[
                        { title: 'Id', field: 'id', editable: 'never', defaultSort: 'desc' },
                        {
                            title: 'Padrão Matriz',
                            field: 'padraoId',
                            lookup: this.state.padroes,
                        },
                        {
                            title: 'Solvente',
                            field: 'solventeId',
                            lookup: this.state.solventes,
                        },
                        {
                            title: 'Equipamento',
                            field: 'equipamentoId',
                            lookup: this.state.equipamentos,
                        },
                        { title: 'Volume', field: 'volume' },
                        {
                            title: 'Unidade',
                            field: 'unidadeId',
                            lookup: this.state.unidades,
                        },
                        { title: 'Entrada', field: 'create_at', type: 'date', editable: 'never' },
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
                                this.criar(newData);
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
            </div>
        )
    }
}

export default Solucao;