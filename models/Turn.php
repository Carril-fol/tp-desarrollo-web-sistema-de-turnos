<?php
require_once  __DIR__ . '/../config.php';

class Turn
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->connection();
    }

    public function createTurn($idUser, $idMedic, $dateAtention, $dateCreation, $turnTime)
    {   
        $paramsQuery = [
            ":idUser" => $idUser, 
            ":idMedic" => $idMedic, 
            ":dateAtention" => $dateAtention, 
            ":dateCreation" => $dateCreation, 
            ":turnTime" => $turnTime
        ];
        $insertQuery = "INSERT INTO turno (id_user, id_medico, fecha_atencion, fecha_creacion, horario, estado)
            VALUES (:idUser, :idMedic, :dateAtention, :dateCreation, :turnTime, 'PENDIENTE')";
        $resultQuery = $this->db->prepare($insertQuery);
        $result = $resultQuery->execute($paramsQuery);
        if (!$result) {
            return false;
        }
        return true;
    }

    public function getAllTurns()
    {
        $selectQuery = "SELECT * FROM turno";
        $resultQuery = $this->db->prepare($selectQuery);
        $resultQuery->execute();
        $rows = $resultQuery->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

}
?>