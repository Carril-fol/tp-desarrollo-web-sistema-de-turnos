<?php
    require("../database.php");

    class PersonModel {
        private $db;
        public String $dni;
        public String $firstName;
        public String $lastName;
        public String $email;
        public String $password;
        public String $status;

        public function __construct(String $dni, String $firstName, String $lastName, String $email, String $password, String $status) {
            $this->dni = $dni;
            $this->firstName = $firstName;
            $this->lastName = $lastName;
            $this->email = $email;
            $this->password = $password;
            $this->status = $status;
        }
        
    }

?>