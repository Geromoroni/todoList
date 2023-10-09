<?php

class taskModel {

    private function getConection() {
        return new PDO('mysql:host=localhost;dbname=db_tareas;charset=utf8', 'root', '');
    }
    
        
    /**
 * Obtiene y devuelve de la base de datos todas las tareas.
 */
  function getTasks() {
      // 1. Abro la conexion
      $db = $this-> getConection();
      // 2. Envia la consulta (2 sub-pasos: prepare y execute)
      $query = $db->prepare('SELECT * FROM tareas');
      $query->execute();
      // 3. Obtengo la respuesta con un fetchAll (porque son muchos)
       $tasks = $query->fetchAll(PDO::FETCH_OBJ); //arreglo de tareas
  
      return $tasks;
}


/**
 * Inserta la tarea en la base de datos
 */
function insertTask($title, $description, $priority) {
    $db = $this ->getConection();

    $query = $db->prepare('INSERT INTO tareas (titulo, descripcion, prioridad) VALUES(?,?,?)');
    $query->execute([$title, $description, $priority]);

    return $db->lastInsertId();
}



function deleteTask ($id){
    $db = $this ->getConection();

    $query = $db -> prepare("DELETE FROM tareas WHERE id = ? ");
    $query ->execute ([$id]);
}

function updateTask ($id){
    $db = $this ->getConection();

    $query = $db -> prepare("UPDATE tareas SET finalizada = 1 WHERE id = ? ");
    $query-> execute ([$id]);

}

}