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

        public static function extractAllByUser($userId): array{

            $arrayTask = [];

            try{

                $db = new JSONDB(self::$directoryDB);

                $arrayDB = $db -> select( '*' ) -> from ( self::$fileName ) -> where( [ 'userId' => $userId ] ) -> get();

                foreach ($arrayDB as $objDB) {
                            
                    $objTask = new Task(
                        $objDB["name"],
                        $objDB["userId"],
                        $objDB["taskId"]
                    );

                    $arrayTask[] = $objTask;
                    
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

        public static function update(Task $objTask): bool{

            $operationDone = false;

            try{

                $db = new JSONDB(self::$directoryDB);

                $db->update( [ 
                    'name' => $objTask->getName(),
                    'taskId' => $objTask->getTaskId(),
                    'userId' => $objTask->getUserId(),
                ] )
                ->from( self::$fileName )
                ->where( [ 'taskId' => $objTask->getTaskId() ])
                ->trigger();

                $operationDone = true;

            } catch (\Throwable $th){

            }

            return $operationDone;

        }

    }

?>