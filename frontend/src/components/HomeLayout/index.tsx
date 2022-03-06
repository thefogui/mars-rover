import React, { Component } from 'react'

import { Container } from './styles';

import Grid from './../Grid';

import Input from './../Input';

export default class HomeLayout extends Component {
    render() {
        return (
            <Container>
              <p>This is a simulation to the test the execution of a simple command.  </p>
              <p>The world shape is 10x10 and has one abstacles. Also has edges, the world is flat :)</p>
              <p>The button simulate put the rover in the given position and display the result</p>
              <p>This simulation is key sensitive and all input need to be filled or might not work properly3</p>


              <Grid />

              <div className="form-container">
                <Input text="Position x" name="x" id="x" />
                <Input text="Position y" name="y" id="y" />
                <Input text="Direction" name="direction" id="direction" />
                <Input text="Command" name="command" id="command" />
              </div>
            </Container>
        );
    };
};
