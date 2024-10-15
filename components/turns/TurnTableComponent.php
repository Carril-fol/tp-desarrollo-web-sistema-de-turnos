<?php
    function renderTurnTable($turns) {
        if (empty($turns)) {
            echo "<div>No hay turnos por el momento a mostrar</div>";
        } else {
            echo "<table border='2'>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>USER ID</th>
                            <th>MEDICO ID</th>
                            <th>FECHA ATENCION</th>
                            <th>FECHA CREACION</th>
                            <th>HORARIO</th>
                            <th>ESTADO</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>";

            foreach ($turns as $row) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['id']) . "</td>
                        <td>" . htmlspecialchars($row['id_user']) . "</td>
                        <td>" . htmlspecialchars($row['id_medico']) . "</td>
                        <td>" . htmlspecialchars($row['fecha_atencion']) . "</td>
                        <td>" . htmlspecialchars($row['fecha_creacion']) . "</td>
                        <td>" . htmlspecialchars($row['horario']) . "</td>
                        <td>" . htmlspecialchars($row['estado']) . "</td>
                        <td>
                            <a href='edit_turn.php?id=" . $row['id'] . "'>
                                <button type='button'>Editar</button>
                            </a>
                            <a href='delete_turn.php?id=" . $row['id'] . "'>
                                <button type='button'>Borrar</button>
                            </a>
                        </td>
                    </tr>";
            }

            echo "  </tbody>
                </table>";
        }
    }
?>