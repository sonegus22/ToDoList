<?php

require_once(__DIR__ . "/../database/TaskRepository.php");

class Task {

    private string  $name;
    private string  $userId;
    private int     $taskId;

    public function __construct(string $taskId,string $name, string $userId) {
        if($taskId == ''){
            $this->taskId = uniqid();
        } else {
            $this->taskId = $taskId;
        }
        
        $this->name = $name;
        $this->userId = $userId;
    }

    public function getName(): string {
        return $this->name;
    }
    public function setName(string $name): void {
        $this->name = $name;
    }

    public function getUserId(): string {
        return $this->userId;
    }
    public function setUserId(string $userId): void {
        $this->userId = $userId;
    }

    public function getTaskId(): int {
        return $this->taskId;
    }
    public function setTaskId(int $taskId): void {
        $this->taskId = $taskId;
    }
    
}

?>