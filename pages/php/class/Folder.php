<?php

class Folder{

    private string $name;
    private Folder $nextFolder;
    private Record $firstRecord;
    private int $folderId;
    private static int $folderIdCounter = 0;
    
    public function __construct(string $namePar){
        $this->name = $namePar;
        $this->nextFolder = null;
        $this->firstRecord = null;
        $this->folderId = self::$folderIdCounter;
        self::$folderIdCounter++; 
    }

    public function getName(){
        return $this->name;
    }
    public function setName(string $namePar){
        $this->name = $namePar;
    }

    public function getNextFolder(){
        return $this->nextFolder;
    }
    public function setNextFolder(Folder $nextFolderPar){
        $this->nextFolder = $nextFolderPar;
    }

    public function getFirstRecord(){
        return $this->firstRecord;
    }
    public function setFirstRecord(Record $firstRecordPar){
        $this->firstRecord = $firstRecordPar;
    }

    public function getFolderId(){
        return $this->folderId;
    }
    public function setFolderId(int $folderIdPar){
        $this->folderId = $folderIdPar;
    }

    public function getFolderIdCounter(){
        return self::$folderIdCounter;
    }
    public function setFolderIdCounter(int $folderIdCounterPar){
        self::$folderIdCounter = $folderIdCounterPar;
    }



}

?>