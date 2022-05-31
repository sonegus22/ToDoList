<?php
    echo "
    <form action = './controller/controller.php?controller=login&action=register' method = 'POST'>
        <label> Username </label> <br>
        <input type = 'text' name = 'username'> <br>
        <label> Password </label> <br>
        <input type = 'text' name = 'password'> <br>
        <label> Conferma password </label> <br>
        <input type = 'text' name = 'passwordConfirm'> <br>
        <input type = 'submit' value = 'Invia'>
    </form> ";
?>