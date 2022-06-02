<?php

    require("../class/User.php");
    require("../class/Task.php");


    /**
     * Get the controller and the action from the URL with the GET method
     */
    $controller = '';
    $action = '';

    if(isset($_GET["controller"])){
        $controller = $_GET["controller"];
    }
     
    if(isset($_GET["action"])){
        $action = $_GET["action"];
    }

    if($controller == "login"){

        if($action == "login"){
            $username = '';
            $password = '';

            if(isset($_POST["username"])){
                $username = $_POST["username"];
            }

            if(isset($_POST["password"])){
                $password = $_POST["password"];
            }

            $userLoggedId = User::login($username, $password);

            if($userLoggedId == '-1'){
                
                header("Location: ../loginpage.php");
                echo '<p id="errorData"> Username o password errati </p>';  // non stampa l'errore
                
            } else {
                    
                echo '<p id="successData"> Benvenuto '.$username.' </p>';
                $userLogged = TaskRepository::extractAllByUser($userLoggedId);

                json_encode($userLogged);

                foreach($userLogged as $task){
                    echo '<p class="task">' . $task->getName() . '</p>';
                }

            }

        } else if($action == "register"){

            $username = $_POST['username'];
            $password = $_POST['password'];
            $passwordConfirm = $_POST['passwordConfirm'];

            $newUser = User::register($username, $password, $passwordConfirm);

        }

    } else if($controller == "task"){

        if($action == "addTask"){

            $userId = $_GET['userId'];
            $taskName = $_GET['taskName'];
            $taskDescription = $_GET['taskDescription'];

            $newTask = TaskRepository::insert(new Task('', $taskName, $userId));

        } else if($action == "editTask"){

            $taskId = $_GET['taskId'];
            $taskName = $_GET['taskName'];

            $editTask = TaskRepository::update($taskId, $taskName);

        } else if($action == "deleteTask"){

            $taskId = $_GET['taskId'];
            $deleteTask = TaskRepository::delete($taskId);

        } else if($action == "getTask"){

            $taskId = $_GET['taskId'];
            $getTask = TaskRepository::extractAllByUser($taskId);

        }

    }

?>