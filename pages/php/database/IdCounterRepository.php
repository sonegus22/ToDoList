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

        /*
         * This method gets the last user id;
         */
        public static function extract(): int {

            $idCounter = 0; // Creating a variable to return
            try{

                $db = new JSONDB(self::$directoryDB); // Loading the database
                // Fetching all the fields from the specified file and save it into arrayDB
                $arrayDB = $db -> select( '*' ) -> from ( self::$fileName ) -> get(); // 
                
                foreach ($arrayDB as $objDB) { // 

                    $idCounter = $objDB["counter"];
                }

            } catch (\Throwable $th){

            }

            return $idCounter;

        }

        public static function insert(int $idCounter) : bool{

            $operationDone = false;

            try{

                $db = new JSONDB(self::$directoryDB);
                
                $db -> insert(
                    self::$tableName,
                    [
                        'counter' => $idCounter
                    ]
                );

                $operationDone = true;

            } catch (\Throwable $th){

            }

            return $operationDone;
        }

        public static function update(int $idCounter) : bool{

            $operationDone = false;

            try{

                $db = new JSONDB(self::$directoryDB);
                
                $db -> update(
                    [
                        'counter' => $idCounter
                    ]
                )

                -> from( self::$fileName )
                -> trigger();

                $operationDone = true;

            } catch (\Throwable $th){

            }

            return $operationDone;
        }

    }

?>