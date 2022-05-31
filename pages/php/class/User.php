<?php

require_once('../database/LoginRepository.php');
require_once('../database/IdCounterRepository.php');

class User {

    private int $userId;
    private string $username;
    private string $password;
    private static int $userIdCounter = 1;

    public function __construct(int $userIdPar, string $usernamePar, string $passwordPar){
        if($userIdPar == 0){
            $this->userId = User::$userIdCounter;
            User::$userIdCounter++;
        } else {
            $this->userId = $userIdPar;
        }
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

            echo"$users->userId";

            ?>
                </p>
            <?php

        }

    }*/

    public static function login(string $usernamePar, string $passwordPar): int{
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

        if($userLogged == null){
            $ret = -1;
        }else{
            $ret = $userLogged->userId;
        }
        
        return $ret;
    }

    public static function register(string $usernamePar, string $passwordPar, string $passwordConfirmPar){

        $tryUser = LoginRepository::extractUsername($usernamePar);
        if($tryUser == null){

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

        } else{
            
            $usernameTry = $tryUser->getUsername();

            if($usernamePar == $usernameTry){
                echo "<p class='userFound'>User already exists</p>";
            } else{

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

         /*else{

            if($usernamePar == "" || $passwordPar == "" || $passwordConfirmPar == ""){

                echo "<p class='userFound'>Please fill all the fields</p>";

            } 
            else {
            
                
            }
        }*/
    }
}

?>