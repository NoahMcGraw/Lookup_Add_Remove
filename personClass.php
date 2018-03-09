<?php
    class Person {

        public $isValid = true;
        public $name;
        public $age;
        public $email;

        public function __construct($name, $age, $email){

            $this->name = $name;
            $this->age = $age;
            $this->email = $email;
        }

        public function whoami() {

            echo "I am  " . $this->name . ", I am " . $this->age;
            echo " years old, and my email address is " . $this->email ;
        }
    }
?>