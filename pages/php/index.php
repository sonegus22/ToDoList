<?php

    require("./class/users.php");

    $prova = new User (2, "Ste", "ssaaass");
    $test = loginRepository::insert($prova);
    echo $test;

    $prova->getAll();
?>