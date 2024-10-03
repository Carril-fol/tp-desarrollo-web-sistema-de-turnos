<?php
require_once  __DIR__ . '/../config.php';
require_once __DIR__ . '/../models/User.php';

class Medic
{
    private $db;
    private $userModel;

    public function __construct()
    {
        $this->db = (new Database())->connection();
        $this->userModel = new User;
    }

    private function checkIfMedicExists($medicLicense)
    {
        $paramsQuery = [":matricula" => $medicLicense];
        $selectQuery = "SELECT matricula FROM medico WHERE matricula = :matricula";
        $resultQuery = $this->db->prepare($selectQuery);
        $resultQuery->execute($paramsQuery);
        return $resultQuery->rowCount() > 0;
    }

    public function createMedic(int $idUser, string $medicLicense, string $medicSpeciality)
    {   
        $existsMedic = $this->checkIfMedicExists($medicLicense);
        if ($existsMedic) {
            return false;
        }
        $paramsQuery = [":id_user"=>$idUser, ":matricula"=>$medicLicense, ":especialidad"=>$medicSpeciality];
        $insertQuery = "INSERT INTO medico (id_user, matricula, especialidad) VALUES (:id_user, :matricula, :especialidad)";
        $resultQuery = $this->db->prepare($insertQuery);
        $resultQuery->execute($paramsQuery);
        return true;
    }

    public function getMedicByDni($dni)
    {   
        $idUser = $this->userModel->getDataFromUserByDni($dni)['id'];
        $paramsQuery = [":id_user"=>$idUser];
        $selectQuery = "SELECT * FROM medico WHERE id_user = :id_user";
        $resultQuery = $this->db->prepare($selectQuery);
        $resultQuery->execute($paramsQuery);
        $row = $resultQuery->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

}

?>