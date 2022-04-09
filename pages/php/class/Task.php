<?php

class Task {

    private string $name;
    private Record $recordFather;
    private Task $nextTask;
    private int $taskId;
    private static int $taskIdCounter = 0;
    
    public function __construct(string $namePar, Record $recordFatherPar){
        $this->name = $namePar;
        $this->recordFather = $recordFatherPar;
        $this->nextTask = null;
        self::$taskIdCounter++;
        $this->taskId = self::$taskIdCounter;
    }

    public function getName(){
        return $this->name;
    }
    public function setName(string $namePar){
        $this->name = $namePar;
    }

    public function getRecordFather(){
        return $this->recordFather;
    }
    public function setRecordFather(Record $recordFatherPar){
        $this->recordFather = $recordFatherPar;
    }

    public function getNextTask(){
        return $this->nextTask;
    }
    public function setNextTask(Task $nextTaskPar){
        $this->nextTask = $nextTaskPar;
    }

    public function getTaskId(){
        return $this->taskId;
    }
    public function setTaskId(int $taskIdPar){
        $this->taskId = $taskIdPar;
    }

    public function getTaskIdCounter(){
        return self::$taskIdCounter;
    }
    public function setTaskIdCounter(int $taskIdCounterPar){
        self::$taskIdCounter = $taskIdCounterPar;
    }

    

}

?>