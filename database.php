<?php

    class Database {
        private String $databaseName = "sistema_de_turnos"
        private String $serverName = "localhost";
        private String $username = "root";
        private String $password = "";
        private int $port = 3306;

        function conexion() {
            $conexion = new mysqli($serverName, $username, $password, $databaseName, $port);
            if ($conexion -> connect_error) {
                die("Connection fail: " . $conexion -> connect_error);
            } else {
                return $conexion;
            }
        }

    }

?>