<?php

if (!isset($_SESSION)) {
    echo "Error al iniciar la sesión.";
} else {
    echo "Sesión iniciada correctamente.";
}

?>