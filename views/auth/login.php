<?php
    session_start();
    if (isset($_SESSION['error'])) {
        echo "<div style='color: red;'>Error: " . "Dni o Contraseña invalida" . "</div>";
        unset($_SESSION['error']);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centro Clinico Vitalis</title>
    <link rel="stylesheet" href="../../css/App.css">
    <link rel="shortcut icon" href="../../assets/images/logo.webp" type="image/x-icon">
</head>
<body class="formularios">
    <h1>Formulario de ingreso</h1>
    <form action="../../controllers/auth/LoginController.php" method="POST">
        <input type="text" name="dni" placeholder="DNI"/>
        <input type="password" name="password" placeholder="Password"/>
        <input type="submit" value="Iniciar Sesion">
        <a href="register.php" style="color:white;">Registrar</a>
    </form>
</body>
</html>