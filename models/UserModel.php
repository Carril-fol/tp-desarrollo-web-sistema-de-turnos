<?php
require_once  __DIR__ . '/../config.php';

class UserModel 
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->conexion();
    }

    private function checkIfUserExists($dni)
    {
        $selectQuery = "SELECT * FROM usuario WHERE dni = '$dni'";
        $resultQuery = $this->db->query($selectQuery);
        return $resultQuery->num_rows > 0;
    }

    public function formatUserData($userData)
    {
        $formatData = mysqli_fetch_array($userData);
        return $formatData;
    }

    public function createCookieData($dataUser)
    {
        $timeExp = time() + 12345;
        $cookieData = array('data'=>$dataUser, 'exp'=>$timeExp);
        $cookie = setcookie('accessToken', json_encode($cookieData), $timeExp);
        return $cookie;
    }

    public function createUser($dni, $firstName, $lastName, $email, $password, $status)
    {   
        $existsUser = $this->checkIfUserExists($dni);
        if (!$existsUser)
        {
            $passwordHashed = password_hash($password, PASSWORD_BCRYPT);
            $insertQuery = "INSERT INTO usuario (dni, nombre, apellido, email, contraseña, estado) 
                VALUES ('$dni', '$firstName', '$lastName', '$email', '$passwordHashed', '$status')";
            $resultQuery = $this->db->query($insertQuery);
            return $resultQuery;
        }
        else
        {
            return FALSE;
        }
    }

    public function getUserByDni($dni)
    {
        $selectQuery = "SELECT * FROM usuario WHERE dni = '$dni'";
        $resultQuery = $this->db->query($selectQuery);
        return $resultQuery;
    }
}

?>