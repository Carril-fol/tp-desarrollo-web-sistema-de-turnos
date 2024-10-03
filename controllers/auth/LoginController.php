<?php 
    // Importes
    require '../../config.php';
    require '../../models/User.php';

    // Instancia de modelo
    $userModel = new User;

    // Iniciar sesion
    session_start();

    // Try - Catch
    try {
        // Información del formulario
        $dni = htmlentities(addslashes($_POST["dni"]));
        $password = htmlentities(addslashes($_POST["password"]));

        $userDataLogin = $userModel->getDniAndPasswordFromUserByDni($dni);
        $passwordHashed = $userDataLogin['contraseña'];

        if (!password_verify($password, $passwordHashed)) {
            throw new Exception("Las contraseñas no son iguales");
        }
        
        $userDataLogged = $userModel->getDataFromUserByDni($dni);
        $userModel->createCookieData($userDataLogged);

        header("Location: ../../views/core/home.php");
        exit();
    }
    catch (Exception $error) {
        $_SESSION['error'] = $error;
        header("Location: ../../views/auth/login.php");
        exit();
    }
?>