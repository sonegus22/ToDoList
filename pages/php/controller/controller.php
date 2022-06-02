<?php

    header("Content-Type: application/json");

    require("../class/User.php");
    require("../class/Task.php");


    // get the controller and the action from the URL with the GET method
    $controller = '';
    $action = '';
    $userLogged = '';


    if(isset($_GET["controller"])){
        $controller = $_GET["controller"];
    }
     
    if(isset($_GET["action"])){
        $action = $_GET["action"];
    }

    // check the controller value
    if($controller == "login"){
        // check the action value if login process the login request
        if($action == "login"){

            // get the username and the password from the form
            $username = '';
            $password = '';
            if(isset($_POST["username"])){
                $username = $_POST["username"];
            }
            if(isset($_POST["password"])){
                $password = $_POST["password"];
            }
            // try to log the user
            $userLoggedId = User::login($username, $password);
            // verify if the user is logged or has provided the right credentials
            if($userLoggedId == '-1'){

                header ("Location: ../../html/login.php?error=1");  // non stampa l'errore
                
            } else {
                    
                echo '<p id="successData"> Benvenuto '.$username.' </p>';
                $userLogged = $userLoggedId;
                $tasks = TaskRepository::extractAllByUser($userLoggedId);

                $data = json_encode($tasks);
                echo $data;

                foreach($tasks as $task){
                    echo '<p class="task">' . $task->getName() . '</p>';
                }

                header('Location: ../../html/task.html');

            }
        // if register process the register request
        } else if($action == "register"){

            // get the username, the password and the passwordConfirm from the form
            if(isset($_POST["username"])){
                $username = $_POST["username"];
            }
            if(isset($_POST["password"])){
                $password = $_POST["password"];
            }
            if(isset($_POST["passwordConfirm"])){
                $passwordConfirm = $_POST["passwordConfirm"];
            }

            // create a new user
            $newUser = User::register($username, $password, $passwordConfirm);

        }
    // if controller value is task process tasks operations
    } else if($controller == "task"){
        // if action value is addTask process the add task request
        if($action == "addTask"){

            $data = json_decode(file_get_contents('php://input'));
            $taskName = $data->taskName;
            echo $taskName;
            // insert a new task in the database with provided parameters
            $newTask = TaskRepository::insert(new Task('', $taskName, $userLogged));

        } else if($action == "editTask"){

            $taskId = $_POST['taskId'];
            $taskName = $_POST['taskName'];

            $editTask = TaskRepository::update($taskId, $taskName);

        } else if($action == "deleteTask"){

            $taskId = $_POST['taskId'];
            $deleteTask = TaskRepository::delete($taskId);

        } else if($action == "getTask"){

            $taskId = $_POST['taskId'];
            $getTask = TaskRepository::extractAllByUser($taskId);

        }

    }

?>