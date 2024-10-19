<?php
function renderTurnTable($turns) {
    if (empty($turns)) {
        echo "
            <div>
                No hay turnos por el momento a mostrar
            </div>
        ";
    } else {
        echo "
            <div class='container-table-button-top'>
                <a href='../../views/turn/createTurn.php'>
                    <button class='table-button-add'>
                        Agregar
                    </button>
                </a>
            </div>
        ";
        echo "<table class='content-table'>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>DNI - Paciente</th>
                        <th>DNI - Medico</th>
                        <th>Fecha atención</th>
                        <th>Fecha creación</th>
                        <th>Horario</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>";

        foreach ($turns as $row) {
            echo 
                "<tr>
                    <td>" . htmlspecialchars($row['id']) . "</td>
                    <td>" . htmlspecialchars($row['dni_paciente']) . "</td>
                    <td>" . htmlspecialchars($row['dni_medico']) . "</td>
                    <td>" . htmlspecialchars($row['fecha_atencion']) . "</td>
                    <td>" . htmlspecialchars($row['fecha_creacion']) . "</td>
                    <td>" . htmlspecialchars($row['horario']) . "</td>
                    <td>" . htmlspecialchars($row['estado']) . "</td>
                    <td>
                        <div class='container-buttons-table-aside'>
                            <a href='../../controllers/turn/TurnController.php?action=update&id=" . htmlspecialchars($row['id']) . "'>
                                <button class='table-button-update' type='button'>Editar</button>
                            </a>
                            <a href='../../controllers/turn/TurnController.php?action=delete&id=" . htmlspecialchars($row['id']) . "'>
                                <button class='table-button-delete' type='button'>Eliminar</button>
                            </a>
                        </div>
                    </td>
                </tr>";
        }
        echo "  </tbody>
            </table>";
    }
}
?>
