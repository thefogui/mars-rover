## Rover Mars

This project contains my solution to the following problem:

You are given the initial starting point (x,y) of a rover and the direction (N,S,E,W) it is facing.
- The rover receives a collection of commands. (E.g.) FFRRFFFRL
- The rover can move forward (f).
- The rover can move left/right (l,r).
- Suppose we are on a really weird planet that is square. 200x200 for example :)
- Implement obstacle detection before each move to a new square. If a given
sequence of commands encounters an obstacle, the rover moves up to the last possible point, aborts the sequence and reports the obstacle.

I started this project by creating the backend, which consist in an API. The .htaccess file is to help create friendly routes for the API.
In the backend we have an index.php which receives the API call and calls the controller. The controller is the controller folder. The idea is every time someone calls the index.html decides which controller call and which function to call. For example, if we have the following URL: '/controller/add/5/5/N', the index will call the class Controller and call the function add(5, 5, N) which create a robot at position 5 5 and facing N. The backend needs a database to save the results and read the rover position to be completed.

In the src folder, we can find the source code for the classes and for the controllers, also includes the config file. The tests' folder includes the tests for the files in the src.

To resolve the problem, I have created a square world where all the edges are considered as obstacle and also there are obstacles spread over the world. The robot start in a position and can make 3 different movements, go forward, turn right and turn left. When the order is turn right or turn left the robot will change the direction that is facing and will keep the position and when the order is going forward the robot will move in the direction that is facing and keep the same direction. The robot will follow the instructions unless he found an obstacle or and edge. At that moment it returns the position where the robot stop and where the object is found

In the frontend, we have a React app with typescript. It consists in a basic simulation of the rover following a set of commands in a pre-defined world. 

##### Steps to run the application:

1 - Open the PHP server
2 - Go to <server>/mars-rover/index.php

The app saves the server URL on the localStorage, so we can read it in the frontend. 
