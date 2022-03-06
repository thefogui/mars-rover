import React, { Component } from 'react'

import { Container, Label } from './styles'

interface DataProps {
    text: string,
    name: string,
    id: string,
};

export default class Input extends Component<DataProps, DataProps> {
    render() {
        return (
            <Container>
                <Label>
                    <input type="text" id={this.props.id} name={ this.props.name } placeholder="&nbsp;" />
                    <span className="label">{ this.props.text }</span>
                    <span className="focus-bg"></span>
                </Label>
            </Container>
        );
    };
};
