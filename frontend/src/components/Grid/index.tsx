import React, { Component } from 'react'
import axios from 'axios';

import {
    Container,
    Cell
} from './styles';

interface MyProps {

}

interface MyState {
    position : number,
    totalColumns : number,
}

export default class Grid extends Component<MyProps, MyState> {

    constructor(props : any) {
        super(props);
        this.state = {
          position: 1,
          totalColumns: 10
        };

        this.sendData = this.sendData.bind(this);
    }

    getArrow(direction : string) : string {
        if (direction === "N"){
            return "↑";
        } else if (direction === "W"){
            return "←";
        } else if (direction === "S"){
            return "↓";
        } else {
            return "→";
        }
    }

    changePosition(x: number, y: number, direction: string) : any {
        var totalCol = this.state.totalColumns;
        var position = this.state.position;

        var newPosition = y  * totalCol + x + 1;

        var div = document.querySelector(".cell:nth-child(" + position + ")");

        if (div != null) {
            div.setAttribute("style", "");
            div.textContent = "";
        }

        var newDiv = document.querySelector(".cell:nth-child(" + newPosition + ")");

        if (newDiv != null) {
            newDiv.setAttribute("style", "background-color:#0bab64");
            newDiv.textContent = this.getArrow(direction);
        }

        this.setState({ position: newPosition });
    }

    generateGrid()  {
        const n = this.state.totalColumns;

        var grid = new Array(n).fill(new Array(n).fill(<Cell className="cell" />));

        return grid;
    }

    sendData() : any {
        var ox = 2;
        var oy = 2;

        this.createObstacle(ox, oy);

        var urlToCall = localStorage.getItem('server') + '/backend/Controller/explore/';
        if (urlToCall === null) urlToCall = '';
        var x = (document.getElementById('x') as HTMLInputElement).value;;
        var y = (document.getElementById('y') as HTMLInputElement).value;;
        var direction = (document.getElementById('direction') as HTMLInputElement).value;;
        var command = (document.getElementById('command') as HTMLInputElement).value;
        urlToCall += x + '/' + y + '/' + direction + '/0/0/10/10/' + ox + '/' + oy + '/' + command;

        axios.get(urlToCall)
        .then(res => {
            var data = JSON.parse(res.data.data);

            if (data.error){
                var p = document.querySelector("#message");

                var positionObj = data.position.split(',');

                var position = positionObj[0].substring(2).split(':');
                var positionX = parseInt(position[0]);
                var positionY = parseInt(position[1]);
                var positionDirection = position[2];

                if (p != null) {
                    p.textContent = data.error + ", " + positionObj[1];
                }

            } else {
                var positionArray = data.position.split(':');
                var positionX = parseInt(positionArray[0]);
                var positionY = parseInt(positionArray[1]);
                var positionDirection = positionArray[2];
            }

            this.changePosition(positionX, positionY, positionDirection);

        });
    }

    createObstacle(x: number, y: number) {
        var totalCol = this.state.totalColumns;
        var obstaclePos = (y - 1 ) * totalCol + x;
        document.getElementsByClassName("cell")[obstaclePos - 1].setAttribute("style", "background-color:#fe0944");
    }

    render() {
        const styles = {
            display: 'grid',
            gridTemplateColumns: `repeat(10, 30px)`,
            gridTemplateRows: `repeat(10, 30px)`
        };

        const table = this.generateGrid();

        return (
            <Container>
                <div style = { styles }>
                    {table.map(x => x.map((y : any) => { return y }))}
                </div>

                <button id="one" onClick={this.sendData} >Simulate</button>
                <p id="message"></p>
            </Container>
        );
    };
};
