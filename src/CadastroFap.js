import React from 'react';
import Axios from 'axios';

class CadastroFap extends React.Component {    
    constructor(props) {
        super(props);

        this.state = {
            posts: []
        };
    }

    componentDidMount(){
        Axios.get('https://localhost:44302/api/Faps')
        .then(response => {
            console.log(response.data);
            let cadastro = response.data.slice(0, 5);
            this.setState({
                posts: cadastro
            })
        }).catch(error => {
            console.log(error);
        });
    }

    render(){
        const test = this.state.posts.map((x) => {
            return (<p key={x.id}> {x.create_at} </p>);
        });
        return (
            <div>
                {test}
            </div>
        );
    }
}

export default CadastroFap;