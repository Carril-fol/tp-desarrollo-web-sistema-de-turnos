<?php 
    require '../../conexion.php';

    $dni = htmlentities(addslashes($_POST["dni"]));
    $password = htmlentities(addslashes($_POST["password"]));

    $query="SELECT * FROM usuario WHERE dni= :dni";

    $resultado = $conexion->prepare($query);

    $resultado->execute(array(":dni"=>$dni));

    $fila = $resultado->fetch(PDO::FETCH_ASSOC);

    $passwordHash = $fila['contraseña'];

    if(password_verify($password, $passwordHash)){
        echo "ingresado";
    }else {
        echo "error al ingresar";
    }
    
?>