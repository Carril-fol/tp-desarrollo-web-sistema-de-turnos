<?php

class Database
{
    public string $databaseName = "sistema_de_turnos";
    public string $serverName = "localhost";
    public string $username = "root";
    public string $password = "";
    public int $port = 3306;

    function connection(){
        try {
            $connection = new PDO(
                "mysql:host={$this->serverName};dbname={$this->databaseName};port={$this->port}", 
                $this->username, 
                $this->password
            );
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection;
        } catch (PDOException $error) {
            echo "Conexion fallida: " . $error->getMessage();
        }
        
    }
}

?>