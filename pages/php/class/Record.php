<?php

class Record {

    private string $name;
    private Folder $folderFather;
    private Record $nextRecord;
    private Task $firstTask;
    private int $recordId;
    private static int $recordIdCounter = 0;

    public function __construct(string $namePar, Folder $folderFatherPar){
        $this->name = $namePar;
        $this->folderFather = $folderFatherPar;
        $this->nextRecord = null;
        $this->firstTask = null;
        self::$recordIdCounter++;
        $this->recordId = self::$recordIdCounter;
    }

    public function getName(){
        return $this->name;
    }
    public function setName(string $namePar){
        $this->name = $namePar;
    }

    public function getFolderFather(){
        return $this->folderFather;
    }
    public function setFolderFather(Folder $folderFatherPar){
        $this->folderFather = $folderFatherPar;
    }

    public function getNextRecord(){
        return $this->nextRecord;
    }
    public function setNextRecord(Record $nextRecordPar){
        $this->nextRecord = $nextRecordPar;
    }

    public function getFirstTask(){
        return $this->firstTask;
    }
    public function setFirstTask(Task $firstTaskPar){
        $this->firstTask = $firstTaskPar;
    }

    public function getRecordId(){
        return $this->recordId;
    }
    public function setRecordId(int $recordIdPar){
        $this->recordId = $recordIdPar;
    }

    public function getRecordIdCounter(){
        return self::$recordIdCounter;
    }
    public function setRecordIdCounter(int $recordIdCounterPar){
        self::$recordIdCounter = $recordIdCounterPar;
    }

    

}

?>