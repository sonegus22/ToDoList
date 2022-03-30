<?php

    require("./class/users.php");

    $prova = new User (2, "Ste", "ssaaass");
    loginRepository::inserisci($prova);

    $prova->getAll();
?>