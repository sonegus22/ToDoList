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


        /**
         * This method extract all the tasks with the given user id
         * @param strin $userId
         * @return array
         */
        public static function extractAllByUser(string $userId): array{ // FIXARE STA FUNZIONE CHE NON VA, IL FOREACH NON STAMPA LA ROBA GIUSTA FARE TEST CON VAR_DUMP

            $arrayTask = [];

            try{

                // New instance of JSONDB for access database
                $db = new JSONDB(self::$directoryDB);
                // Extract all the tasks from the database with a given user id
                $arrayDB = $db -> select( '*' ) -> from ( self::$fileName ) -> where( [ 'userId' => $userId ] ) -> get();

                foreach($arrayDB as $objDB){
                    
                    $objTask = new Task($objDB["taskId"], $objDB["name"], $objDB["userId"]);

                    $arrayTask[] = $objTask;
                    
                }
                
            } catch (\Throwable $th){
                
            }            
            
            return $arrayTask;

        }

        /**
         * This method insert a new task in the database
         * @param Task $task
         * @return bool $operationDone
         */
        public static function insert(Task $objTask): bool{

            $operationDone = false;

            try{

                // New instance of JSONDB for access database
                $db = new JSONDB(self::$directoryDB);
                // Insert a new task in the database
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

        /**
         * This method delete a specific task from the database
         * @param string $taskId
         * @return bool $operationDone
         */
        public static function delete(string $taskId): bool{

            $operationDone = false;

            try{

                // New instance of JSONDB for access database
                $db = new JSONDB(self::$directoryDB);
                // Delete a specific task in the database
                $db -> delete() -> from( self::$fileName ) -> where( [ 'taskId' => $taskId ] ) -> trigger();

                $operationDone = true; 

            } catch(\Throwable $th) {

            }

            return $operationDone;


        }

        /**
         * This method update a specific task from the database
         * @param string $userId
         * @param string $taskName
         * @return bool $operationDone
         */
        public static function update(string $userId, String $taskName): bool{

            $operationDone = false;

            try{

                // New instance of JSONDB for access database
                $db = new JSONDB(self::$directoryDB);
                // Update a specific task in the database
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

        /**
         * This method extract a specific task from the database
         * @param string $taskId
         * @return Task $objTask
         */
        public static function extractTask(string $taskId): Task{

            $objTask = null;

            try{

                // New instance of JSONDB for access database
                $db = new JSONDB(self::$directoryDB);
                // Extract a specific task from the database
                $arrayDB = $db -> select( '*' ) -> from ( self::$fileName ) -> where( [ 'taskId' => $taskId ] ) -> get();

                foreach ($arrayDB as $objDB) {
                            
                    $objTask = new Task($objDB["taskId"], $objDB["name"], $objDB["userId"]);

                }

            } catch (\Throwable $th){

            }
            
            return $objTask;
        }
    }


?>