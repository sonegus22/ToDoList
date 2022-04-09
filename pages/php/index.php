<?php

    require("./class/user.php");

    $prova = new User (2, "Ste", "ssaaass");
    $test = LoginRepository::insert($prova);
    echo $test;

    //$prova->getAll();
    
?>