<?php 
include_once "./app/models/task.model.php";
include_once "./app/views/task.view.php";
class taskController {

    private $model;
    private $view;

    function __construct()
    {
        $this-> model = new taskModel();
        $this -> view = new taskView();
    }

    function showTasks(){
        require "templates/header.php";
    
        //obtengo las tareas del modelo
        $tasks = $this->model->getTasks();
        
        //actualizo la vista
        $this-> view -> showTasks($tasks);
    }

      

function addTask(){
    //obtengo los datos del usuario
    $title = $_POST ["title"];
    $priority = $_POST["priority"];
    $description = $_POST ["description"];
    
    //inserto en la DB
     $id = $this ->model->insertTask($title, $description, $priority);

     if ($id) {
        // redirigo la usuario a la pantalla principal
        header('Location: ' . BASE_URL);
    } else {

    $this -> view -> showError("Faltan datos");
    die();
    }
}


function removeTask ($id){
    $this->model->deleteTask($id);
    header('Location: ' . BASE_URL);
}



function finishTask($id){

    $this ->model->updateTask($id);
    header('Location: ' . BASE_URL);
  
  }
  
}

