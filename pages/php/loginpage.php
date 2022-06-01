<?php
    echo "
    <form action = './controller/controller.php?controller=login&action=login' method = 'POST'>
        <label> Username </label> <br>
        <input type = 'text' name = 'username'> <br>
        <label> Password </label> <br>
        <input type = 'text' name = 'password'> <br>
        <input type = 'submit' value = 'Invia'>
    </form> 
    <a href = './registration.php'> 
        Registrati
    </a>
    ";
?>