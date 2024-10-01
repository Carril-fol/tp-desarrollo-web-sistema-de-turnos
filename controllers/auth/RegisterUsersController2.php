<?php 
    require '../../conexion.php';

    try{
        $nombre = strtoupper($_POST['firstName']);
        $apellido = strtoupper($_POST['lastName']);
        $occupation = strtoupper($_POST['occupation']);
        $dni = $_POST['dni'];
        $email = strtolower($_POST['email']);
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];

        if ($password === $confirmPassword) {
            $password_cifrada = password_hash($password, PASSWORD_DEFAULT);
        }

        $query = "INSERT INTO usuario (dni, nombre, apellido, email, contraseña) VALUES (:dni, :nombre, :apellido, :email, :password_cifrada)";

        $resultado = $conexion->prepare($query);

        $resultado->execute(array(":dni" => $dni, "nombre" => $nombre, "apellido" => $apellido, "email" => $email, "password_cifrada" => $password_cifrada));

        echo "Registro insertado";
        header("Refresh:3 ; url=../../views/auth/login.php");

    }catch (Exception $e) {
        echo "linea del error: " . $e->getLine();
    }finally{
        $conexion = null;
    }
?>