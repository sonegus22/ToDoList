<!DOCTYPE html>
<html>

	<head>

        <title>Login</title>
        <meta charset="UTF-8">
		<link href="../css/stileLogin.css" rel ="stylesheet" type ="text/css">

	</head>
    <body>

        <?php
            if($_GET["error"] == 1) {
                echo '<script> alert("Username o password errati") </script>';
            }
        ?>

        <form class = "centerMainform" action = '../php/controller/controller.php?controller=login&action=login' method="POST">
            <div>
            <img id="imgLog" src="..\img\avatarLog.png" alt="Avatar" class="avatar">
            <br>
            <label id="usernameLabel" for="Username">Username</label><br>
            <input type="text" id="username" name="username" value=""><br>

            <label id="passwordLabel" for="password">Password</label><br>
            <input type="password" id="password" name="password" value=""><br><br>

            <button id="buttonLog" type="submit">Login</button>
            <a id="linkLogin" href="./signup.html">Registati qui</a>
          </div>
        </form> 

    </body>


</html>