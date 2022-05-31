<?php

    require_once("./IdCounterRepository.php"); 

    class IdCounter {

        private int counter = 1;

        public function __construct ( int $counter) {
            $this->counter = $counter;
        }

    }

?>