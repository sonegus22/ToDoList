<?php

require_once("../database/TaskRepository.php");

class Task {

    private string $name;
    private int $userId;
    private int $taskId;
    private static int $taskIdCounter = 1;

    public function __construct(string $name, int $userId) {
        $this->name = $name;
        $this->userId = $userId;
        $this->taskId = $this->taskIdCounter;
        Task::$taskIdCounter++;
    }

    public function getName(): string {
        return $this->name;
    }
    public function setName(string $name): void {
        $this->name = $name;
    }

    public function getUserId(): int {
        return $this->userId;
    }
    public function setUserId(int $userId): void {
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