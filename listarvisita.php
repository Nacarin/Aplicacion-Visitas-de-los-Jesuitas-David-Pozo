<?php
    // Incluye el archivo de configuración de la base de datos y la clase Visita
    require_once('config.php');
    require_once('visita.php'); // Asegúrate de tener una clase Visita definida

    // Inicializa la conexión a la base de datos
    $db = new mysqli($db_host, $db_user, $db_pass, $db_name);

    // Crea una instancia de la clase Visita
    $visita = new Visita($db);

    // Llama al método listarVisitas para obtener la lista de visitas desde la base de datos
    $visitasLista = $visita->listarVisitas();

    if (!empty($visitasLista)) {
        // Si la lista de visitas no está vacía, muestra una tabla con los datos
        echo '<h2>Lista de Visitas</h2>';
        echo '<table>';
        echo '<tr><th>ID Visita</th><th>ID Jesuita</th><th>Fecha</th></tr>';
        foreach ($visitasLista as $visitaDatos) {
            // Itera a través de los datos de cada visita y muestra cada visita en una fila de la tabla
            echo '<tr>';
            echo '<td>' . $visitaDatos['idVisita'] . '</td>';
            echo '<td>' . $visitaDatos['idJesuita'] . '</td>';
            echo '<td>' . $visitaDatos['fechaHora'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        // Si no hay visitas en la base de datos, muestra un mensaje indicando que no hay visitas.
        echo 'No hay visitas en la base de datos.';
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Listado de Visitas</title>
        <link rel="stylesheet" type="text/css" href="estilos.css">
    </head>
    <body>
        <form>
        <h2>Volver al Índice</h2>
        <a href="index.html">Inicio</a>
        </form>
    </body>
</html>

