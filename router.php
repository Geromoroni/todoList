<?php

require_once "app/tasks.php";
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
        showTasks();
        break;

    case "agregar":
        addTask();
        break;

    case "eliminar";
    removeTask($params[1]);
        break;

    case "finalizar";
    finishTask($params[1]);
    break;
    default:
    echo "404 error";
        break;
}