<?php
    session_start();
    if (isset($_SESSION['error'])) {
        echo "<div style='color: red;'>Error: " . $_SESSION['error'] . "</div>";
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
</head>
<body class="formularios">
    <h1>Formulario de Registro de usuario</h1>
    <form action="../../controllers/auth/RegisterUsersController.php" method="POST">
        <input type="text" name="firstName" placeholder="Nombre"/>
        <input type="text" name="lastName" placeholder="Apellido"/>
        <input type="text" name="dni" placeholder="DNI" pattern="^\d{8}$" title="El DNI debe tener 8 dígitos." required/>
        
        <select name="occupation" id="occupationSelect" required onchange="checkOccupation()">
            <option value="Seleccione una opcion">Seleccione una opcion</option>
            <option value="Medico">Medico</option>
            <option value="Administrativo">Administrativo</option>
            <option value="Paciente">Paciente</option>
        </select>

        <div id="additionalInputs">
        </div>
        
        <input type="email" name="email" placeholder="Email" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title="Ingrese un correo electrónico válido." required/>
        <input type="password" name="password" placeholder="Contraseña"  required/>
        <input type="password" name="confirmPassword" placeholder="Confirmar contraseña" required/>        
        <input type="submit" value="Dar de alta">
        <a href="login.php" style="color:white;">volver al Ingreso</a>
    </form>
</body>

<script>
    function checkOccupation() {
        const occupation = document.getElementById("occupationSelect").value;
        const additionalInputs = document.getElementById("additionalInputs");

        additionalInputs.innerHTML = ''

        switch (occupation) {
            case 'Medico':
                additionalInputs.innerHTML = `
                    <input type="text" name="medicLicense" placeholder="Número de licencia médica" required/>
                    <input type="text" name="specialty" placeholder="Especialidad médica" required/>
                `;
                break;
            case 'Paciente':
                additionalInputs.innerHTML = `
                    <input type="text" name="numberHealthInsurance" placeholder="Número de obra social" required/>
                    <label for="isPartner">Es socio</label>
                    <input type="checkbox" name="isPartner" required/>
                `;
        }
    }
    checkOccupation();
</script>

</html>

