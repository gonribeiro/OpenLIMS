import React from 'react';
import axios from 'axios';
import MaterialTable from 'material-table';

class Equipamento extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            data: [],
            tiposEquipamento: {}, // tiposEquipamento tem que ser coleção para campo combobox
        }
    }

    componentDidMount(){
        this.listarEquipamento();
        this.listarTipoEquipamento();
    }

    listarEquipamento = () => {
        axios.get('http://localhost:53048/api/equipamento')
        .then(response => {
            let data = response.data;
            this.setState({
                data: data
            })
        }).catch(error => {
            console.log(error);
        });
    }

    listarTipoEquipamento = () => {
        axios.get('http://localhost:53048/api/tipoequipamento')
        .then(response => {
            // Formata o retorno da unidade para listar adequadamente no combobox do data-table
            // Pega somente os tiposEquipamento e salva em array
            let tiposEquipamento = response.data.map((item, key) =>
                item.tipo
            );
            // Formata array em string com indice de todas os tiposEquipamento
            let tipoEquipamentoFormatadaParaComboBox = tiposEquipamento.reduce(function(acc, cur, i) {
                acc[i+1] = cur;
                return acc;
            }, {});
            this.setState({
                tiposEquipamento: tipoEquipamentoFormatadaParaComboBox
            })
        }).catch(error => {
            console.log(error);
        });
    }
    
    criar = (item) => {
        axios.post('http://localhost:53048/api/equipamento', {
            nome: item.nome,
            tipoEquipamentoId: parseInt(item.tipoEquipamentoId),
            valor: item.valor,
            notaFiscal: item.notaFiscal,
            create_at: new Date()
        })
        .then(reponse => {
            this.listarEquipamento();
        }).catch(error => {
            alert('Erro: Não foi possível criar');
        });
    }

    atualizar = (event, item) => {
        axios.put('http://localhost:53048/api/equipamento/'+event, {
            id: item.id,   
            nome: item.nome,
            tipoEquipamentoId: parseInt(item.tipoEquipamentoId),
            valor: item.valor,
            notaFiscal: item.notaFiscal
        })
        .then(reponse => {
            this.listarEquipamento();
        }).catch(error => {
            alert('Erro: Não foi possível atualizar');
        });
    }
    
    apagar = (item) => {
        axios.delete('http://localhost:53048/api/equipamento/'+item)
        .then(response => {
            this.listarEquipamento();
        }).catch(error => {
            alert('Erro: Não foi possível apagar');
        });
    }
  
    render() {
        return (
            <MaterialTable
                title="Equipamentos"
                columns={[
                    { title: 'Id', field: 'id', editable: 'never', defaultSort: 'desc' },
                    { title: 'Equipamento', field: 'nome' },
                    {
                        title: 'Tipo do Equipamento',
                        field: 'tipoEquipamentoId',
                        lookup: this.state.tiposEquipamento,
                    },
                    { title: 'Valor', field: 'valor' },
                    { title: 'Nota Fiscal', field: 'notaFiscal' },
                    { title: 'Entrada', field: 'create_at', type: 'date', editable: 'never' },
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
                detailPanel={rowData => {
                    const url = "http://localhost:3000/Calibracao/"+rowData.id;
                    return (
                        <iframe
                            width="100%"
                            height="250"
                            src={url}
                            frameborder="0"
                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen
                        />
                    )
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

export default Equipamento;