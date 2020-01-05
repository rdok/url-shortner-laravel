import React, { Component } from 'react';
import ReactDOM from 'react-dom';

export default class Welcome extends Component {
    render() {
        return (
            <div className="card">
                <div className="card-header">Guest</div>
            </div>
        );
    }
}

if (document.getElementById('welcome-view')) {
    ReactDOM.render(<Welcome />, document.getElementById('welcome-view'));
}
