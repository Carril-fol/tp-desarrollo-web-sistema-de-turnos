<?php
require_once __DIR__ . '/User.php';
require_once __DIR__ . '/../config.php';

class Administrative
{
    private $db;
    private $userModel;

    public function __construct()
    {
        $this->db = (new Database())->connection();
        $this->userModel = new User;
    }
    
    private function checkIfAdministrativeExists($paramsQuery)
    {
        $selectQuery = "SELECT id_user FROM administrativo WHERE id_user = :id_user";
        $resultQuery = $this->db->prepare($selectQuery);
        $resultQuery->execute($paramsQuery);
        return $resultQuery->rowCount() > 0;
    }

    public function createAdministrative(int $idUser)
    {
        $paramsQuery = [':id_user'=>$idUser];
        $checkIfAdministrativeExists = $this->checkIfAdministrativeExists($paramsQuery);
        if ($checkIfAdministrativeExists) {
            return false;
        }
        $insertQuery = "INSERT INTO administrativo (id_user) VALUES (:id_user)";
        $resultQuery = $this->db->prepare($insertQuery);
        $resultQuery->execute($paramsQuery);
        return $resultQuery;
    }

    public function getAdministrativeByDni($dni)
    {
        $userData = $this->userModel->getDataFromUserByDni($dni);
        $paramsQuery = [':id_user'=>$userData['id']];
        $selectQuery = "SELECT * FROM administrativo WHERE id_user = :id_user";
        $resultQuery = $this->db->prepare($selectQuery);
        $resultQuery->execute($paramsQuery);
        $row = $resultQuery->fetch(PDO::FETCH_ASSOC);
        return $row;
    }
}
?>