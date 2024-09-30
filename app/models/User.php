<?php

require_once  __DIR__ . '/../config.php';

class User
{
    private $db;
    public $dni;
    public $firstName;
    public $lastName;
    public $email;
    public $password;
    public $status;

    public function __construct()
    {
        $this->db = (new Database())->conexion();
    }

    public function formatUserData($userData)
    {
        $formatData = mysqli_fetch_array($userData);
        return $formatData;
    }

    private function checkIfUserExists($dni): bool
    {
        $selectQuery = "SELECT dni FROM usuario WHERE dni = '$dni'";
        $resultQuery = $this->db->query($selectQuery);
        return $resultQuery->num_rows > 0;
    }

    public function createUser($dni, $firstName, $lastName, $email, $password, $status): bool|mysqli_result         
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

    public function getDniAndPasswordFromUserByDni($dni): bool|mysqli_result
    {
        $selectQuery = "SELECT dni, contraseña FROM usuario WHERE dni = '$dni'";
        $resultQuery = $this->db->query($selectQuery);
        return $resultQuery;
    }

    public function getDataFromUserByDni($dni)  
    {
        $selectQuery = "SELECT dni, nombre, apellido, email, estado FROM usuario WHERE dni = '$dni'";
        $resultQuery = $this->db->query($selectQuery);
        return $resultQuery;
    }
}

