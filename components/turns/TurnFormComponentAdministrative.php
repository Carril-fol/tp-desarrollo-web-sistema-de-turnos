<?php
    function turnFormComponentAdministrative() {
        echo "
            <form class='formulario-turno-creacion' method='POST' action='../../controllers/turn/TurnController.php?action=create'>
                <div>
                    <img src='../../assets/images/logo.webp' alt='Logo'/>
                    <h1>Crea tu turno</h1>
                </div>
                <input type='text' name='dniPatient' placeholder='Dni del paciente'>
                <input type='date' name='dateAtention'>
                <input type='time' name='timeAtention'>
                <select required name='speciality'>
                    <option value='Selecione una opcion' selected>Selecione una opcion</option>
                    <option value='Medico General'>Medico General</option>
                </select>
                <button type='submit'>
                    Crear
                </button>
            </form>
        ";
    }
    turnFormComponentAdministrative();

?>