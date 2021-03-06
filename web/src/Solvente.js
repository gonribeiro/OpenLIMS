import React from 'react';
import axios from 'axios';
import MaterialTable from 'material-table';

class Solvente extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            data: [],
        }
    }

    componentDidMount(){
        this.listarSolventes();
    }

    listarSolventes = () => {
        axios.get('http://localhost:53048/api/solvente')
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
        axios.post('http://localhost:53048/api/solvente', {
            nome: item.nome
        })
        .then(reponse => {
            this.listarSolventes();
        }).catch(error => {
            alert('Erro: Não foi possível criar');
        });
    }

    atualizar = (event, item) => {
        axios.put('http://localhost:53048/api/solvente/'+event, { 
            id: item.id,
            nome: item.nome
        })
        .then(reponse => {
            this.listarSolventes();
        }).catch(error => {
            alert('Erro: Não foi possível atualizar');
        });
    }
    
    apagar = (item) => {
        axios.delete('http://localhost:53048/api/solvente/'+item)
        .then(response => {
            this.listarSolventes();
        }).catch(error => {
            alert('Erro: Não foi possível apagar');
        });
    }
  
    render() {
        return (
            <MaterialTable
                title="Solventes"
                columns={[
                    { title: 'Id', field: 'id', editable: 'never', defaultSort: 'desc' },
                    { title: 'Solvente', field: 'nome' },
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
        )
    }
}

export default Solvente;