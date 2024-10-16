<?php
require_once  __DIR__ . '/../config.php';
require_once __DIR__ . '/../models/User.php';

class Medic
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->connection();
    }

    private function checkIfMedicExists($medicLicense)
    {
        $paramsQuery = [
            ":matricula" => $medicLicense
        ];
        $selectQuery = "SELECT matricula FROM medico WHERE matricula = :matricula";
        $resultQuery = $this->db->prepare($selectQuery);
        $resultQuery->execute($paramsQuery);
        return $resultQuery->rowCount() > 0;
    }

    public function createMedic(int $dni, string $medicLicense, string $medicSpeciality)
    {   
        $existsMedic = $this->checkIfMedicExists($medicLicense);
        if ($existsMedic) {
            return false;
        }
        $paramsQuery = [
            ":dni"=>$dni, 
            ":matricula"=>$medicLicense, 
            ":especialidad"=>$medicSpeciality
        ];
        $insertQuery = "INSERT INTO medico (dni, matricula, especialidad) VALUES (:dni, :matricula, :especialidad)";
        $resultQuery = $this->db->prepare($insertQuery);
        $resultQuery->execute($paramsQuery);
        return true;
    }

    public function getMedicByDni($dni)
    {   
        $paramsQuery = [":dni"=>$dni];
        $selectQuery = "SELECT * FROM medico WHERE $dni = :dni";
        $resultQuery = $this->db->prepare($selectQuery);
        $resultQuery->execute($paramsQuery);
        $row = $resultQuery->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

}

?>