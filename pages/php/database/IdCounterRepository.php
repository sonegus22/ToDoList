<?php

    require_once("JSONDB.php");
    require_once("json.php");
    require_once("dataTypes.php");

    use \Jajo\JSONDB;

    class IdCounterRepository {

        private static string $directoryDB = __DIR__;
        private static string $tableName = 'idCounter';
        private static string $fileName = 'idCounter.json';
        //public static int $id = 1;

        public static function extract(){

            $objCounter = null;
            try{

                $db = new JSONDB(self::$directoryDB);
                $arrayDB = $db -> select( '*' ) -> from ( self::$fileName ) -> get();

                foreach ($arrayDB as $objDB) {

                    $objCounter = new IdCounter (
                        $objDB["counter"]
                    );

                }

            } catch (\Throwable $th){

            }

            return $objCounter;

        }

    }

?>