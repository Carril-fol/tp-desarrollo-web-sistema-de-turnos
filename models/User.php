<?php
require_once  __DIR__ . '/../config.php';

class User
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->connection();
    }

    private function checkIfUserExists($dni): bool
    {   
        $paramsQuery = [':dni'=>$dni];
        $selectQuery = "SELECT dni FROM usuario WHERE dni = :dni";
        $resultQuery = $this->db->prepare($selectQuery);
        $resultQuery->execute($paramsQuery);
        return $resultQuery->rowCount() > 0;
    }

    public function createCookieData($dataUser)
    {
        $timeExp = time() + 86400;
        $cookieData = array('data'=>$dataUser, 'exp'=>$timeExp);
        setcookie('accessToken', json_encode($cookieData), $timeExp, "/");
    }

    public function createUser($dni, $firstName, $lastName, $email, $password, $isSuperUser, $isStaff)
    {   
        $existsUser = $this->checkIfUserExists($dni);
        if ($existsUser) {
            return false;
        }
        $paramsQuery = [
            ":dni" => $dni, 
            ":firstName" => $firstName, 
            ":lastName" => $lastName, 
            ":email" => $email, 
            ":password" => $password,
            ":isSuperUser" => $isSuperUser,
            ":isStaff" => $isStaff
        ];
        $insertQuery = "INSERT INTO usuario (dni, nombre, apellido, email, contraseña, estado, esSuperUsuario, esStaff) 
            VALUES (:dni, :firstName, :lastName, :email, :password, 'ALTA', :isSuperUser, :isStaff)";

        $resultQuery = $this->db->prepare($insertQuery);
        $result = $resultQuery->execute($paramsQuery);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getDniAndPasswordFromUserByDni($dni)
    {   
        $paramsQuery = [":dni"=>$dni];
        $selectQuery = "SELECT dni, contraseña FROM usuario WHERE dni = :dni";
        $resultQuery = $this->db->prepare($selectQuery);
        $resultQuery->execute($paramsQuery);
        $row = $resultQuery->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    public function getDataFromUserByDni($dni)
    {   
        $paramsQuery = [':dni'=>$dni];
        $selectQuery = "SELECT id, dni, nombre, apellido, email FROM usuario WHERE dni = :dni";
        $resultQuery = $this->db->prepare($selectQuery);
        $resultQuery->execute($paramsQuery);
        $row = $resultQuery->fetch(PDO::FETCH_ASSOC);
        return $row;
    }
}

?>