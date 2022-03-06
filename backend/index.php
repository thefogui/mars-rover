<?php
/**
 * This script is the core of the api, it is responsible to call the controllers created on the folder controller
 *
 * @author     Vitor Carvalho vitorthefogui@gmail.com
 * @version    v1
 * @since      06/03/2022
 */
session_start();

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-type: application/json');


include(__DIR__  . '/src/controller/Controller.php');

class Rest {
    public static function open($server) {

       $url = explode('/', $server['REQUEST_URI']);

        //cleaning the url: remove empty strings, null and false
        $url = array_filter($url, function($a) {
            return trim($a) !== "";
        });

        array_shift($url); //remove the start
        array_shift($url); //remove backend
        $classCalled = $url[0];
        $classMethod = $url[1];
        array_shift($url);
        array_shift($url);
        $classCalledPath = __DIR__ . '/src/controller/' . $classCalled . '.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $params = $_POST;
        } else {
            $params = $url;
        }

        if (file_exists($classCalledPath)) {
            $data = call_user_func_array(array(new $classCalled, $classMethod), $params);

            $response = json_encode(array('status' => 'success', 'data' => $data));
        } else {
            $response = json_encode(array('status' => 'error', 'data' => 'Class not found!'));
        }

        echo $response;
    }
}

if (isset($_SERVER['REQUEST_URI'])) {
    Rest::open($_SERVER);
}
