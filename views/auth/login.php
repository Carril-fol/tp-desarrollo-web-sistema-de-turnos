<?php

    function errorInSession()
    {
        session_start();
        if (isset($_SESSION['error'])) {
            echo "<div style='color: red;'>Error: " . "Dni o Contraseña invalida" . "</div>";
            unset($_SESSION['error']);
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centro Clinico Vitalis</title>
    <link rel="stylesheet" href="../../css/auth/Auth.css">
    <link rel="stylesheet" href="../../css/App.css">
    <link rel="shortcut icon" href="../../assets/images/logo.webp" type="image/x-icon">
</head>
<body>
    <?php
        include("../../components/common/header.html");
    ?>
    <section class="section-formulario-login">
        <form class="formulario-login" action="../../controllers/auth/LoginController.php" method="POST">
            <div class="formulario-login-logo-titulo">
                <img src="../../assets/images/logo.webp" alt="Logo"/>
                <h1>Iniciar Sesión</h1>
            </div>
            <div>
                <input type="text" name="dni" placeholder="DNI" pattern="^\d{8}$" required/>
            </div>
            <div>
                <input type="password" name="password" placeholder="Contraseña" required/>
            </div>
            <?php errorInSession(); ?>
            <div>
                <button type="submit">Iniciar Sesión</button>
            </div>
        </form>
    </section>
    <?php
        include("../../components/common/footer.html");
    ?>
</body>
</html>