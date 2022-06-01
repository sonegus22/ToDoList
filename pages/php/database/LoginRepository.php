<?php

    require_once("JSONDB.php");
    require_once("json.php");
    require_once("dataTypes.php");

    use \Jajo\JSONDB;

    class LoginRepository{

        private static string $directoryDB = __DIR__;
        private static string $tableName = 'login';
        private static string $fileName = 'login.json';
        public static int $id = 0;

        public static function extractAll(): array{

            $arrayLogin = [];

            try{

                $db = new JSONDB(self::$directoryDB);

                $arrayDB = $db -> select( '*' ) -> from ( self::$fileName ) -> get();

                foreach ($arrayDB as $objDB) {

                    $objLogin = new User(
                        $objDB["userId"],
                        $objDB["username"],
                        $objDB["password"]
                    );

                }

                $arrayLogin[] = $objLogin;

            } catch (\Throwable $th){
            
            }

            return $arrayLogin;

        }

        /**
         * This method extract a specified user from the database
         * @param string $username The username of the user
         * @return User The user object
         **/        
        public static function extract(string $username){

            $objUser = null;
            try{

                $db = new JSONDB(self::$directoryDB);
                $arrayDB = $db -> select( '*' ) -> from ( self::$fileName ) -> where( [ 'username' => $username ] ) -> get();

                foreach ($arrayDB as $objDB) {

                    $objUser = new User (
                        $objDB["userId"],
                        $objDB["username"],
                        $objDB["password"]
                    );

                }

            } catch (\Throwable $th){

            }

            return $objUser;

        }

        /**
         * This method insert a new user into the database
         * @param User $user The user object
         * @return bool True if the operation is done, false otherwise
         */
        public static function insert(User $objUser): bool {

            $operationDone = false;

            self::$id += 1;
            $objUser -> setUserId(self::$id);

            try {

                $db = new JSONDB(self::$directoryDB);

                $db->insert( 
                    self::$tableName, 
                    [
                        'userId' => $objUser->getUserId(),
                        'username' => $objUser->getUsername(),
                        'password' => $objUser->getPassword()
                    ]
                );

                $operationDone = true;

            } catch (\Throwable $th) {

            }

            return $operationDone;
            
        }

        /**
         * This method delete a specified user from the database
         * @param string $username The username of the user
         * @return bool True if the operation is done, false otherwise
         */
        public static function delete(string $username): bool{

            $operationDone = false;

            try{

                $db = new JSONDB(self::$directoryDB);
                $db -> delete() -> from( self::$fileName ) -> where( [ 'username' => $username ] ) -> trigger();
                $operationDone = true; 
 
            } catch(\Throwable $th) {

            }

            return $operationDone;

        }

        /**
         * This method extract the username and the password from the database to check the login
         * @param string $username The username of the user
         * @param User $objUser The user object
         */
        public static function extractUsernamePassword(string $username){

            $objUser = null;
            try{

                $db = new JSONDB(self::$directoryDB);
                $arrayDB = $db -> select( '*' ) -> from ( self::$fileName ) -> where( [ 'username' => $username ] ) -> get();

                foreach ($arrayDB as $objDB) {

                    $objUser = new User (
                        $objDB[null],
                        $objDB["username"],
                        $objDB["password"]
                    );

                }

            } catch (\Throwable $th){

            }

            return $objUser;

        }

        /**
         * This method extract the username to check the presence of a user in the database
         * @param string $username The username of the user
         * @return bool True if the user is present, false otherwise
         */
        public static function extractUsername(string $username){

            $objUser = null;
            try{

                $db = new JSONDB(self::$directoryDB);
                $arrayDB = $db -> select( '*' ) -> from ( self::$fileName ) -> where( [ 'username' => $username ] ) -> get();

                foreach ($arrayDB as $objDB) {

                    $objUser = new User (
                        $objDB[null],
                        $objDB["username"],
                        ""
                    );

                }

            } catch (\Throwable $th){

            }

            return $objUser;

        }

    }

?>