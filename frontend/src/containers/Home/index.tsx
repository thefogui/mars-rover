import React, { Component } from 'react'

import { Container } from './styles'

import HomeLayout from './../../components/HomeLayout';

export default class Home extends Component {
    render() {
        return (
            <Container>
                <HomeLayout />
            </Container>
        );
    };
};
