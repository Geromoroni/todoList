<?php
include_once "app/controllers/task.controller.php";

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');



$action = "listar";

if(!empty($_GET["action"])){
    $action = $_GET["action"];
}

//listar -> showTask();
//agregar -> addTask();
//eliminar/:ID -> removeTask($id);
//finalizar/:ID -> finishTask($id);
$params = explode("/", $action);


switch($params[0]){
    case "listar":
        $controller = new taskController();
        $controller -> showTasks();
        break;

    case "agregar":
        $controller = new taskController();
        $controller -> addTask();
        break;

    case "eliminar";
    $controller = new taskController();
    $id = $params[1];
    $controller -> removeTask($id);

    break;

    case "finalizar";
    $controller = new taskController();
    $id = $params[1];
    $controller -> finishTask($id);
    break;

    default:
    echo "404 error";
        break;
}