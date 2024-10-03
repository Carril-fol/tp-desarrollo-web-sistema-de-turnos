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

    public function createPatient(int $idUser, string $numberHealthInsurance, bool $isPartner)
    {
        $insertQuery = "INSERT INTO paciente (id_user, numero_de_obra_social, es_socio) 
            VALUES (:id_user, :numero_de_obra_social, :es_socio)";
        $stmt = $this->db->prepare($insertQuery);
        $stmt->bindParam(':id_user', $idUser, PDO::PARAM_INT);
        $stmt->bindParam(':numero_de_obra_social', $numberHealthInsurance, PDO::PARAM_STR);
        $stmt->bindParam(':es_socio', $isPartner, PDO::PARAM_BOOL);
        $resultQuery = $stmt->execute();
        return $resultQuery;
    }

    public function getPatientByDni($dni)
    {
        $idUser = $this->userModel->getDataFromUserByDni($dni);
        $selectQuery = "SELECT * FROM paciente WHERE id_user = :id_user";
        $stmt = $this->db->prepare($selectQuery);
        $stmt->bindParam(':id_user', $idUser, PDO::PARAM_INT);
        $resultQuery = $stmt->execute();
        return $resultQuery;
    }

}

?>