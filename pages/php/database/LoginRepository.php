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

        public static function insert(User $objUser): bool {

            $operationDone = false;

            $objUser->setPassword(password_hash($objUser->getPassword(), PASSWORD_DEFAULT));

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

    }

?>