<?php
require_once(__DIR__ . "\..\database\login.php");

class User {

    public int $userId;
    public string $username;
    public string $password;

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

    public function setUsername (int $usernamePar){
        $this->username = $usernamePar;
    }

    public function setPassword (int $passwordPar){
        $this->password = $passwordPar;
    }
    
    public function getAll(){

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

    }

}

?>