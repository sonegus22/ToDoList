<?php

    require_once("JSONDB.php");
    require_once("json.php");
    require_once("dataTypes.php");

    use \Jajo\JSONDB;

    class loginRepository{

        private static string $directoryDB = __DIR__;
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

        /**
         * Inserisce nel DB l'istanza di SmartTV specificata
         * @param SmartTv $objSmartTV Istanza da inserire
         * @return bool Risultato dell'operazione: true = successo, false = fallimento
         */
    
        public static function inserisci(User $objUser): bool {
            $operazioneRiuscita = false;
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

                $operazioneRiuscita = true;

            } catch (\Throwable $th) {

            }

            return $operazioneRiuscita;
            
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


    }

?>