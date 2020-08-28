import React, { useState, useEffect } from 'react';
import axios from 'axios';
import TextField from '@material-ui/core/TextField';
import Autocomplete from '@material-ui/lab/Autocomplete';
import { makeStyles } from '@material-ui/core/styles';
import 'date-fns';
import DateFnsUtils from '@date-io/date-fns';
import { MuiPickersUtilsProvider, KeyboardDatePicker } from '@material-ui/pickers';

const useStyles = makeStyles(theme => ({
    root: {
        width: 300,
        '& > * + *': {
            marginTop: theme.spacing(1),
        },
    },
}));

export default function SolucaoCreate() {
    const [solucao, setSolucao] = useState();
    const top100Films = [
        { title: 'The Shawshank Redemption', year: 1994 },
        { title: 'The Godfather', year: 1972 }
    ];
    const classes = useStyles();
    const [selectedDate, setSelectedDate] = React.useState(new Date('2014-08-18T21:11:54'));
    const handleDateChange = date => {
        setSelectedDate(date);
    };

    useEffect(() => {
        //listarSolucao();
    });

    function listarSolucao() {
        axios.get('http://localhost:53048/api/solucao')
        .then(response => {
            setSolucao(response.data);
        }).catch(error => {
            console.log(error);
        });
    }

    return (
        <div className={classes.root}>
            <Autocomplete
                id="padrao"
                freeSolo
                size="small"
                options={top100Films.map(option => option.title)}
                renderInput={params => (
                    <TextField {...params} label="Padrão" variant="outlined" />
                )}
            />
            <Autocomplete
                id="solvente"
                freeSolo
                size="small"
                options={top100Films.map(option => option.title)}
                renderInput={params => (
                    <TextField {...params} label="Solvente" variant="outlined" />
                )}
            />
            <Autocomplete
                id="equipamento"
                freeSolo
                size="small"
                options={top100Films.map(option => option.title)}
                renderInput={params => (
                    <TextField {...params} label="Equipamento" variant="outlined" />
                )}
            />
            <TextField
                id="outlined-number"
                label="Number"
                size="small"
                type="number"
                InputLabelProps={{
                    shrink: true,
                }}
                variant="outlined"
            /> 
            <Autocomplete
                id="equipamento"
                size="small"
                options={top100Films.map(option => option.title)}
                renderInput={params => (
                    <TextField {...params} label="Equipamento" variant="outlined" />
                )}
            />
            <MuiPickersUtilsProvider utils={DateFnsUtils}>
                <KeyboardDatePicker
                    disableToolbar
                    variant="inline"
                    format="MM/dd/yyyy"
                    margin="normal"
                    id="date-picker-inline"
                    label="Date picker inline"
                    value={selectedDate}
                    onChange={handleDateChange}
                    KeyboardButtonProps={{
                        'aria-label': 'change date',
                    }}
                />
                <KeyboardDatePicker
                    disableToolbar
                    variant="inline"
                    format="MM/dd/yyyy"
                    margin="normal"
                    id="date-picker-inline"
                    label="Date picker inline"
                    value={selectedDate}
                    onChange={handleDateChange}
                    KeyboardButtonProps={{
                        'aria-label': 'change date',
                    }}
                />
            </MuiPickersUtilsProvider>
        </div>
    );
}