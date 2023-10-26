<?php
    // Configuración de la base de datos
    $db_host = '127.0.0.1';  // Dirección IP o nombre del servidor de la base de datos
    $db_name = 'jesuitas';   // Nombre de la base de datos
    $db_user = 'root';      // Nombre de usuario de la base de datos
    $db_pass = '';           // Contraseña de usuario de la base de datos (en este caso, está vacía)

    // Se intenta establecer una conexión a la base de datos usando la extensión MySQLi.
    $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

    // Verificar la conexión
    if ($mysqli->connect_error) {
        die('Error de conexión a la base de datos: ' . $mysqli->connect_error);
    }

?>
