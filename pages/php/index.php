<?php

    require("./class/user.php");

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

?>