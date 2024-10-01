<?php


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST">
        <input type="text" name="firstName" placeholder="Nombre"/>
        <input type="text" name="lastName" placeholder="Apellido"/>
        <input type="text" name="dni" placeholder="DNI" pattern="^\d{8}$" title="El DNI debe tener 8 dígitos." required/>
        <select name="occupation"required>
            <option value="Seleccione una opcion">Seleccione una opcion</option>
            <option value="Medico">Medico</option>
            <option value="Administrativo">Administrativo</option>
            <option value="Paciente">Paciente</option>
        </select>
        <input type="email" name="email" placeholder="Email" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title="Ingrese un correo electrónico válido." required/>
        <input type="password" name="password" placeholder="Contraseña"  required/>
        <input type="password" name="confirmPassword" placeholder="Confirmar contraseña" required/>        
        <input type="submit" value="Dar de alta">
    </form>
</body>
</html>
