<?php
    // Incluye el archivo de configuración de la base de datos y la clase Jesuita
    require_once('config.php');
    require_once('jesuita.php');

    // Inicializa la conexión a la base de datos
    $db = new mysqli($db_host, $db_user, $db_pass, $db_name);
    
    // Crea una instancia de la clase Jesuita, que permite interactuar con la tabla de jesuitas en la base de datos
    $jesuita = new Jesuita($db);

    // Llama al método 'listarJesuitas' para obtener la lista de todos los jesuitas en la base de datos
    $jesuitasListar = $jesuita->listarJesuitas();

    if (!empty($jesuitasListar)) {
        // Si se encontraron jesuitas en la base de datos
        
        // Muestra un encabezado y crea una tabla para mostrar la lista de jesuitas
        echo '<h2>Lista de Jesuitas</h2>';
        echo '<table>';
        echo '<tr><th>ID Jesuita</th><th>Nombre</th><th>Firma</th></tr>';
        
        // Itera a través de la lista de jesuitas y muestra cada uno en una fila de la tabla
        foreach ($jesuitasListar as $jesuitaDatos) {
            echo '<tr>';
            echo '<td>' . $jesuitaDatos['idJesuita'] . '</td>';
            echo '<td>' . $jesuitaDatos['nombre'] . '</td>';
            echo '<td>' . $jesuitaDatos['firma'] . '</td>';
            echo '</tr>';
        }
        
        // Cierra la tabla
        echo '</table>';
    } else {
        // Si no se encontraron jesuitas en la base de datos, muestra un mensaje indicando que no hay jesuitas
        echo 'No hay jesuitas en la base de datos.';
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Listado</title>
        <link rel="stylesheet" type="text/css" href="estilos.css">
    </head>
    <body>
        <h2>Volver al Índice</h2>
        <a href="index.html">Inicio</a>
    </body>
</html>
