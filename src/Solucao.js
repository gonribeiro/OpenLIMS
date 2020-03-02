import React from 'react';
import axios from 'axios';
import MaterialTable from 'material-table';
// Modal
import Modal from '@material-ui/core/Modal';
import Backdrop from '@material-ui/core/Backdrop';
import Fade from '@material-ui/core/Fade';

class Solucao extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            data: [],
            unidades: {}, // unidade tem que ser coleção para campo combobox
        }
    }

    componentDidMount(){
        this.listarSolucao();
        this.listarUnidades();
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
    
    criar = (item) => {
        axios.post('http://localhost:53048/api/solucao', {
            nome: item.nome,
            volume: parseInt(item.volume),
            unidadeId: parseInt(item.unidadeId),
            valor: item.valor,
            notaFiscal: item.notaFiscal,
            create_at: new Date(),
            validade: item.validade
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
                        { title: 'Padrão Matriz', field: 'padrao.nome' },
                        { title: 'Solvente', field: 'solvente.nome' },
                        { title: 'Equipamento', field: 'equipamento.nome' },
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