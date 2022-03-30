<?php

    require_once("JSONDB.php");
    require_once("json.php");
    require_once("dataTypes.php");

    use \Jajo\JSONDB;

    class loginRepository{

        private static string $directoryDB = "../../json";
        private static string $tableName = 'login';
        private static string $fileName = 'login.json';

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

    }

?>