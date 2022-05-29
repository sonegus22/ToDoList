<?php

    $controller = $_GET['controller'];
    $action = $_GET['action'];

    if($controller == "login"){

        if($action == "login"){

            $username = $_POST['username'];
            $password = $_POST['password'];

            $userLoggedId = User::login($username, $password);
            if($userLoggedId == -1){
                
                echo '<p id="errorData"> Username o password errati </p>';
                require_once("#");
                
            } else {
                    
                echo '<p id="successData"> Benvenuto '.$username.' </p>';
                $userLogged = TaskRepository::extractAllByUser($userLoggedId);

                foreach ($userLogged as $task) {
                    echo '<p class="task">'.$task->getName().'</p>';
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

            $userId = $_POST['userId'];
            $taskName = $_POST['taskName'];
            $taskDescription = $_POST['taskDescription'];

            $newTask = TaskRepository::insert(new Task($taskName, $userId));

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