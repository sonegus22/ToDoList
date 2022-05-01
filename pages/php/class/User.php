<?php

require_once('./database/LoginRepository.php');

class User {

    private int $userId;
    private string $username;
    private string $password;

    public function __construct(int $userIdPar, string $usernamePar, string $passwordPar){
        $this->userId = $userIdPar;
        $this->username = $usernamePar;
        $this->password = $passwordPar;
    }

    public function getUserId (){
        return $this->userId;
    }

    public function getUsername (){
        return $this->username;
    }

    public function getPassword (){
        return $this->password;
    }

    public function setUserId (int $userIdPar){
        $this->userId = $userIdPar;
    }

    public function setUsername (string $usernamePar){
        $this->username = $usernamePar;
    }

    public function setPassword (string $passwordPar){
        $this->password = $passwordPar;
    }
    
    /*public function getAll(){

        $arrayUsers = loginRepository::extractAll();

        foreach($arrayUsers as $users){

            ?>
                <p>
            <?php

            echo"
                $users->userId;
            ";

            ?>
                </p>
            <?php

        }

    }*/

    public function login(string $usernamePar, string $passwordPar): int{
        $user = LoginRepository::extractUsernamePassword($usernamePar);
        $userLogged = null;

        if($user != null){

            if(password_verify($passwordPar, $user->password)){
                $userLogged = LoginRepository::extract($usernamePar);
            }else{
                echo "<p class='passwordCorrection'>Password incorrect</p>";
                $userLogged = -1;
            }

        }else{
            echo "<p class='userFound'>User not found</p>";
            $userLogged = 0;
        }
        
        return $userLogged->userId || $userLogged;
    }

    public function register(string $usernamePar, string $passwordPar, string $passwordConfirmPar){

        if($passwordPar == $passwordConfirmPar){

            $user = new User(0, $usernamePar, $passwordPar);
            $insert = LoginRepository::insert($user);

            if($insert){
                echo "<p class='userRegistration'>User registered</p>";
            }else{ 
                echo "<p class='userRegistration'>User not registered</p>";
            }

        }else{

            echo "<p class='passwordError'>Passwords do not match</p>";
        
        }

    }

}

?>