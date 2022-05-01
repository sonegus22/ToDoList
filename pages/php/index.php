<?php

    require("./class/User.php");
    require("./class/Task.php");

    $prova1 = new User (1, "Ste", "ssaaass");
    $test = loginRepository::insert($prova1);
    
    $prova2 = new User (2, "luca", "aaaaa");
    $test = loginRepository::insert($prova2);

    $prova3 = new User (3, "Miao", "lalals");
    $test = loginRepository::insert($prova3); 

    if (loginRepository::delete(1)) {
        echo "eliminato 1";
    } else {
        echo "errore";
    } 

    echo "<br>";

    $test1 = new Task('task1', 1, 1);
    $test2 = TaskRepository::insert($test1);
    $test3 = new Task ('task2', 1, 2);
    $test2 = TaskRepository::insert($test3);
    $test3 = TaskRepository::extractAllByUser(1);
    if($test3 != null){
        foreach($test3 as $task){
            echo $task->getName();
            echo"<br>";
        }    
    }

?>