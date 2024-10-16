<?php
require_once  __DIR__ . '/../config.php';
require_once __DIR__ . '/../models/User.php';

class Patient
{
    private $db;
    private $userModel;

    public function __construct()
    {
        $this->db = (new Database())->connection();
        $this->userModel = new User;
    }

    public function createPatient(int $dni)
    {
        $insertQuery = "INSERT INTO paciente (dni) 
            VALUES (:dni)";
        $stmt = $this->db->prepare($insertQuery);
        $stmt->bindParam(':dni', $dni, PDO::PARAM_INT);
        $resultQuery = $stmt->execute();
        return $resultQuery;
    }

    public function getPatientByDni($dni)
    {
        $idUser = $this->userModel->getDataFromUserByDni($dni);
        $selectQuery = "SELECT * FROM paciente WHERE dni = :dni";
        $stmt = $this->db->prepare($selectQuery);
        $stmt->bindParam(':dni', $dni, PDO::PARAM_INT);
        $resultQuery = $stmt->execute();
        return $resultQuery;
    }

}

?>