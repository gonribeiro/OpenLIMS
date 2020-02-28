import React from 'react';
// NavBar
import { makeStyles } from '@material-ui/core/styles';
import PropTypes from 'prop-types';
import AppBar from '@material-ui/core/AppBar';
import Toolbar from '@material-ui/core/Toolbar';
import useScrollTrigger from '@material-ui/core/useScrollTrigger';
import IconButton from '@material-ui/core/IconButton';
import MenuIcon from '@material-ui/icons/Menu';
import Typography from '@material-ui/core/Typography';
// Menu
import { withStyles } from '@material-ui/core/styles';
import Menu from '@material-ui/core/Menu';
import MenuItem from '@material-ui/core/MenuItem';
import ListItemText from '@material-ui/core/ListItemText';
import Divider from '@material-ui/core/Divider';
// Route Link
import { BrowserRouter as Router } from "react-router-dom";

// NavBar
function ElevationScroll(props) {
    const { children, window } = props;
    // Note that you normally won't need to set the window ref as useScrollTrigger
    // will default to window.
    // This is only being set here because the demo is in an iframe.
    const trigger = useScrollTrigger({
        disableHysteresis: true,
        threshold: 0,
        target: window ? window() : undefined,
    });

    return React.cloneElement(children, {
        elevation: trigger ? 4 : 0,
    });
}

ElevationScroll.propTypes = {
    children: PropTypes.element.isRequired,
    /**
     * Injected by the documentation to work in an iframe.
     * You won't need it on your project.
     */
    window: PropTypes.func,
};

const useStyles = makeStyles(theme => ({
    root: {
      flexGrow: 1,
    },
    menuButton: {
      marginRight: theme.spacing(2),
    },
}));

// Menu
const StyledMenu = withStyles({
    paper: {
        border: '1px solid #d3d4d5',
    },
})(props => (
    <Menu
    elevation={0}
    getContentAnchorEl={null}
    anchorOrigin={{
        vertical: 'bottom',
        horizontal: 'center',
    }}
    transformOrigin={{
        vertical: 'top',
        horizontal: 'center',
    }}
    {...props}
    />
));
  
const StyledMenuItem = withStyles(theme => ({
    root: {
        backgroundColor: theme.palette.main,
        '& .MuiListItemIcon-root, & .MuiListItemText': {
        color: theme.palette.common.white,
        },
    },
}))(MenuItem);

export default function ElevateAppBar(props) {
    // NavBar
    const classes = useStyles();
    
    // Menu
    const [anchorEl, setAnchorEl] = React.useState(null);
    const handleClick = event => {
        setAnchorEl(event.currentTarget);
    };
    const handleClose = () => {
        setAnchorEl(null);
    };

    return (
        <div>
            <React.Fragment>
                <AppBar>
                    <Toolbar>
                        <IconButton edge="start" className={classes.menuButton} color="inherit" aria-label="menu" onClick={handleClick}>
                            <MenuIcon />
                        </IconButton>
                        <Typography variant="h6" color="inherit">
                            LIMS
                        </Typography>
                    </Toolbar>
                </AppBar>
                <Toolbar />
            </React.Fragment>
            <Router>                
                <StyledMenu
                    id="customized-menu"
                    anchorEl={anchorEl}
                    keepMounted
                    open={Boolean(anchorEl)}
                    onClose={handleClose}
                >
                    <StyledMenuItem>
                        <ListItemText primary="Amostras" />
                    </StyledMenuItem>
                    <StyledMenuItem>
                        <ListItemText primary="Analises" />
                    </StyledMenuItem>
                    <Divider />
                    <a href="/Padrao">
                        <StyledMenuItem>
                            <ListItemText primary="Padrões" />
                        </StyledMenuItem>
                    </a>
                    <StyledMenuItem>
                        <ListItemText primary="Soluções" />
                    </StyledMenuItem>
                    <a href="/Unidade">
                        <StyledMenuItem>
                            <ListItemText primary="Unidades" />
                        </StyledMenuItem>
                    </a>
                    <Divider />
                    <a href="/Equipamento">
                        <StyledMenuItem>
                            <ListItemText primary="Equipamentos" />
                        </StyledMenuItem>
                    </a>
                    <a href="/TipoEquipamento">
                        <StyledMenuItem>
                            <ListItemText primary="Tipo de Equipamentos" />
                        </StyledMenuItem>
                    </a>
                    <Divider />
                    <StyledMenuItem>
                        <ListItemText primary="Usuários" />
                    </StyledMenuItem>
                </StyledMenu>
            </Router>
        </div>
    );
}   