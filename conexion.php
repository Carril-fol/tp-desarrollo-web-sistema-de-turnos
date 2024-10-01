<?php 

$serverName = "localhost";
$userName = "root";
$password ="";
$dbName = "sistema_de_turnos";
$port = "3306";

try {
    $conexion = new PDO("mysql:host=$serverName;dbname=$dbName;port=$port", $userName, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "Conexion fallida: " . $e->getMessage();
}

?>