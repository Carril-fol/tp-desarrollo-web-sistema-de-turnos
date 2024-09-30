<?php

class Database
{
    public string $databaseName = "sistema_de_turnos";
    public string $serverName = "localhost";
    public string $username = "root";
    public string $password = "";
    public int $port = 3306;

    function conexion() {
        $connection = new mysqli($this->serverName, $this->username, $this->password, $this->databaseName, $this->port);
        if ($connection -> connect_error) {
            die("Connection fail: " . $connection -> connect_error);
        } else {
            return $connection;
        }
    }
}
