<?php

  class taskView {
    function showTasks($tasks) {
          
        require "templates/form_alta.php"
    
        ?>
         <ul class="list-group">
        <?php foreach($tasks as $task) { ?>
            <li class="list-group-item item-task <?php if($task->finalizada) echo 'finalizada' ?>">
                <div>
                    <b><?php echo $task->titulo ?></b> | (Prioridad <?php echo $task->prioridad ?>)
                </div>
                <div class="actions">
                    <?php if(!$task->finalizada) { ?> <a href="finalizar/<?php echo $task->id ?>" type="button" class='btn btn-success ml-auto'>Finalizar</a> <?php } ?>
                    <a href="eliminar/<?php echo $task->id ?>" type="button" class='btn btn-danger ml-auto'>Borrar</a>
                </div>
            </li>
        <?php } ?>
        </ul>
    
        <?php
    }

     function showError($msg){
        echo "<h1> ERROR! </h1>";
        echo "<h2> $msg </h2>";

     }
  }