<?php

    require_once("JSONDB.php");
    require_once("json.php");
    require_once("dataTypes.php");

    use \Jajo\JSONDB;

    class TaskRepository{

        private static string $directoryDB = __DIR__;
        private static string $tableName = 'task';
        private static string $fileName = 'task.json';
        public static int $id = 0;

        public static function extractAllByUser(string $userId): array{ // FIXARE STA FUNZIONE CHE NON VA, IL FOREACH NON STAMPA LA ROBA GIUSTA FARE TEST CON VAR_DUMP

            $arrayTask = [];

            try{

                $db = new JSONDB(self::$directoryDB);

                $arrayDB = $db -> select( '*' ) -> from ( self::$fileName ) -> where( [ 'userId' => $userId ] ) -> get();

                //var_dump($arrayDB);

                for($i = 0; sizeof($arrayDB); $i++) {
                    
                    /*$objTask = new Task(
                        $objDB["name"],
                        $objDB["userId"],
                        $objDB["taskId"]
                    );*/

                    var_dump($arrayDB[$i]);

                    //array_push($arrayTask, $objTask);
                    
                    //var_dump($objDB);

                }
                
            } catch (\Throwable $th){
                
            }
            
            return $arrayTask;

        }

        public static function insert(Task $objTask): bool{

            $operationDone = false;

            try{

                $db = new JSONDB(self::$directoryDB);

                $db -> insert(
                    self::$tableName,
                    [
                        'name' => $objTask->getName(),
                        'taskId' => $objTask->getTaskId(),
                        'userId' => $objTask->getUserId()
                    ]
                );

                $operationDone = true;

            } catch (\Throwable $th){

            }

            return $operationDone;

        }

        public static function delete(int $taskId): bool{

            $operationDone = false;

            try{

                $db = new JSONDB(self::$directoryDB);

                $db -> delete() -> from( self::$fileName ) -> where( [ 'taskId' => $taskId ] ) -> trigger();

                $operationDone = true; 

            } catch(\Throwable $th) {

            }

            return $operationDone;


        }

        public static function update(int $userId, String $taskName): bool{

            $operationDone = false;

            try{

                $db = new JSONDB(self::$directoryDB);

                $db->update( [ 
                    'name' => $taskName,
                ] )
                ->from( self::$fileName )
                ->where( [ 'taskId' => $userId ])
                ->trigger();

                $operationDone = true;

            } catch (\Throwable $th){

            }

            return $operationDone;

        }

        public static function extractTask(int $taskId): Task{

            $objTask = null;

            try{

                $db = new JSONDB(self::$directoryDB);

                $arrayDB = $db -> select( '*' ) -> from ( self::$fileName ) -> where( [ 'taskId' => $taskId ] ) -> get();

                foreach ($arrayDB as $objDB) {
                            
                    $objTask = new Task(
                        $objDB["name"],
                        $objDB["userId"],
                        $objDB["taskId"]
                    );

                }

            } catch (\Throwable $th){

            }
            
            return $objTask;
        }
    }


?>