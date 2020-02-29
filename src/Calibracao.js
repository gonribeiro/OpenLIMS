import React from 'react';
import axios from 'axios';
import MaterialTable from 'material-table';

class Calibracao extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            data: []
        }
    }

    componentDidMount(){
        // Lista calibrações de acordo com Id do equipamento recebido por get
        this.listarCalibracao(this.props.match.params.equipamentoId);
    }

    listarCalibracao = (equipamentoId) => {
        axios.get('http://localhost:53048/api/calibracao/'+equipamentoId)
        .then(response => {
            let data = response.data;
            this.setState({
                data: data
            })
        }).catch(error => {
            console.log(error);
        });
    }
    
    criar = (item) => {
        axios.post('http://localhost:53048/api/calibracao', {
            calibrado: item.calibrado,
            validade: item.validade,
            equipamentoId: parseInt(this.props.match.params.equipamentoId)
        })
        .then(reponse => {
            this.listarCalibracao(this.props.match.params.equipamentoId);
        }).catch(error => {
            // alert('Erro: Não foi possível criar');
            this.listarCalibracao(this.props.match.params.equipamentoId);
        });
    }

    atualizar = (event, item) => {
        axios.put('http://localhost:53048/api/calibracao/'+event, {
            id: item.id,
            calibrado: item.calibrado,
            validade: item.validade,
            equipamentoId: parseInt(this.props.match.params.equipamentoId)
        })
        .then(reponse => {
            this.listarCalibracao(this.props.match.params.equipamentoId);
        }).catch(error => {
            alert('Erro: Não foi possível atualizar');
        });
    }
    
    apagar = (item) => {
        axios.delete('http://localhost:53048/api/calibracao/'+item)
        .then(response => {
            this.listarCalibracao(this.props.match.params.equipamentoId);
        }).catch(error => {
            alert('Erro: Não foi possível apagar');
        });
    }
  
    render() {
        return (
            <div>
                // Post está retornando com erro no response do back, mesmo que o registro tenha sido criado <br/>
                // Issue aberto no back para solução e posteriormente conserto aqui <br/>
                // Criação, quando feita pelo front adiciona 1 dia a mais do registrado nesta tela 
                <MaterialTable
                    title="Calibrações"
                    columns={[
                        { title: 'Id', field: 'id', editable: 'never', defaultSort: 'desc' },
                        { title: 'Calibrado', field: 'calibrado', type: 'date' },
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

export default Calibracao;