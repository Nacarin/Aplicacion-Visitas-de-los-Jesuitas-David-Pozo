<?php
    require_once('../configuracion/config.php');
    require_once('../clases/lugar.php');

    $db = new mysqli($db_host, $db_user, $db_pass, $db_name);
    $lugar = new Lugar($db);

    if ($db->connect_error) {
        die("Error de conexión a la base de datos: " . $db->connect_error);
    }

    // Verifica si se ha enviado una IP a través del método GET
    if (isset($_GET['ip'])) {
        $ip = $_GET['ip']; // Obtiene la IP de la solicitud GET

        // Busca un lugar en la base de datos usando la IP proporcionada
        $lugarEncontrado = $lugar->buscarLugarPorIP($ip);

        // Verifica si se encontró un lugar con la IP proporcionada
        if ($lugarEncontrado) {
            // Muestra los detalles del lugar encontrado si se halla en la base de datos
            echo '<h2>Resultado de la búsqueda</h2>';
            echo '<p>IP: ' . $lugarEncontrado['ip'] . '</p>';
            echo '<p>Nombre del Lugar: ' . $lugarEncontrado['lugar'] . '</p>';
            echo '<p>Descripción: ' . $lugarEncontrado['descripcion'] . '</p>';
            // Genera un enlace para borrar el lugar utilizando eliminarlugar.php con la IP correspondiente
            echo '<a href="eliminarlugar.php?ip=' . $lugarEncontrado['ip'] . '">Borrar Lugar</a>';
        } else {
            // Si no se encuentra un lugar con la IP proporcionada, muestra un mensaje de error
            echo 'No se encontró un Lugar con la IP proporcionada.';
        }
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Borrar Lugar</title>
        <link rel="stylesheet" type="text/css" href="../estilos/estilos.css">
    </head>
    <body>
      <br/>  
      <a href="./formlugar.php">Lugares</a>
    </body>
</html>


