<?php
    // Incluye los archivos de configuración de la base de datos y la clase Lugar
    require_once('config.php');
    require_once('lugar.php');

    // Inicializa una conexión a la base de datos
    $db = new mysqli($db_host, $db_user, $db_pass, $db_name);

    if ($db->connect_error) {
        die("Error de conexión a la base de datos: " . $db->connect_error);
    }

    // Crea una instancia de la clase Lugar y le pasa la conexión a la base de datos
    $lugar = new Lugar($db);

    // Llama al método para listar lugares
    $lugaresLista = $lugar->listarLugares();

    if (!empty($lugaresLista)) {
        // Si la lista de lugares no está vacía, muestra los lugares en una tabla
        echo '<h2>Lista de Lugares</h2>';
        echo '<table>';
        echo '<tr><th>IP</th><th>Nombre</th><th>Descripción</th></tr>';
        foreach ($lugaresLista as $lugarDatos) {
            // Itera a través de los lugares y muestra cada lugar en una fila de la tabla
            echo '<tr>';
            echo '<td>' . $lugarDatos['ip'] . '</td>';
            echo '<td>' . $lugarDatos['lugar'] . '</td>';
            echo '<td>' . $lugarDatos['descripcion'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        // Si la lista de lugares está vacía, muestra un mensaje indicando que no hay lugares en la base de datos
        echo 'No hay lugares en la base de datos.';
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Listado</title>
        <link rel="stylesheet" type="text/css" href="./estilos/estilos.css">
    </head>
    <body>
        <form></form>
            <h2>Volver al Índice</h2>
            <a href="index.html">Inicio</a>
        </form>
    </body>
</html>
