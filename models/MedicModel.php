<?php
    // Importes
    require("../database.php");
    require("../core/models/PersonaModel.php");

    // Clase
    class MedicModel extends PersonaModel {
        private $db;
        public String $enroll;
        public String $specialty;

        // Constructor
        public function __construct(String $enroll, String $specialty) {
            $this->db = Database::conexion();
            $this->enroll = $enroll;
            $this->specialty = $specialty;
        }
        
        public function create_medic(String $dni, String $firstName, String $lastName, String $email, String $password, String $status, String $enroll, String $specialty) {
            $insertQuery = "INSERT INTO medics (dni, firstName, lastName, email, password, status, enroll, specialty) 
                VALUES ($dni, $firstName, $lastName, $email, $password, $status, $enroll, $specialty)";
            $insertResult = $this->db->query($insertQuery);
        }

    }

?>