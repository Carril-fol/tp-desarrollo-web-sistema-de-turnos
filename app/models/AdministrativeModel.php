<?php
require_once  __DIR__ . '/../config.php';

class AdministrativeModel
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->conexion();
    }
    
    public function createAdministrative(int $idPerson)
    {
        $insertQuery = "INSERT INTO administrativo (id_user) 
            VALUES ($idPerson)";
        $resultQuery = $this->db->query($insertQuery);
        return $resultQuery;
    }

    public function getAdministrativeByDni($dni)
    {
        $idPerson = $this->getUserByDni($dni);
        $selectQuery = "SELECT * FROM administrativo WHERE id_persona = $idPerson";
        $resultQuery = $this->db->query($selectQuery);
        return $resultQuery;
    }
}
?>