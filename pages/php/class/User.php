<?php

require_once('../database/LoginRepository.php');
require_once('../database/IdCounterRepository.php');

class User {

    private int    $userId;
    private string $username;
    private string $password;

    /**
     * The constructor instantiates a user
     * if the userIdPar [User ID] is not set
     * a new UUID is generated and assigned
     * to that attribute.
     * @param int $userIdPar User's identifier [UUID]
     * @param string $usernamePar User's username
     * @param string $passwordPar User's password
     */
    public function __construct(string $userIdPar, string $usernamePar, string $passwordPar){
        // If the userId is not set
        if ($userIdPar == '') {
            $this->userId = uniqid(); // Generate a new Universal Unique IDentifier
        } else {
            $this->userId = $userIdPar; // Set the given one
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

    /**
     * This method checks if the credentials are correct, if they are
     * the user will be redirected to the control panel.
     * @param string $usernamePar The username of the user
     * @param string $passwordPar The password of the user
     * @return int User Id
     */
    public static function login (string $usernamePar, string $passwordPar) : int {
        $user = LoginRepository::extractUsernamePassword($usernamePar);
        $userLogged = null;

        if($user != null){

            if($passwordPar == $user->getPassword()){
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

    /**
     * This method registers a new user if it isn't already registered.
     * @param string $usernamePar The username of the user
     * @param string $passwordPar The password of the user
     * @param string $passwordConfirmPar The password confirmation of the user
     */
    public static function register(string $usernamePar, string $passwordPar, string $passwordConfirmPar){

        $tryUser = LoginRepository::extractUsername($usernamePar);

        if($tryUser == null){

            if($passwordPar == $passwordConfirmPar){

                $user = new User('', $usernamePar, $passwordPar);
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
    }
}

?>