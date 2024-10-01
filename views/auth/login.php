<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../css/App.css">
</head>
<body class="formularios">
    <h1>Formulario de ingreso</h1>
    <form action="../../controllers/auth/LoginController.php" method="POST">
        <input type="text" name="dni" placeholder="DNI"/>
        <input type="text" name="password" placeholder="Password"/>
        <input type="submit" value="Iniciar Sesion">
        <a href="register.php" style="color:white;">Registrar</a>
    </form>
</body>
</html>