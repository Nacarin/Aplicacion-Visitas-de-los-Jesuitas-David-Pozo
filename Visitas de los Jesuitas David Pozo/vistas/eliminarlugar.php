<?php
    require_once('../configuracion/config.php');
    require_once('../clases/lugar.php');

    $db = new mysqli($db_host, $db_user, $db_pass, $db_name);
    $lugar = new Lugar($db);

    if ($db->connect_error) {
        die("Error de conexión a la base de datos: " . $db->connect_error);
    }

    if (isset($_GET['ip'])) {
        $ip = $_GET['ip'];
        
        // Borrar el lugar por su IP
        $lugarEliminado = $lugar->borrarLugar($ip);
        
        if ($lugarEliminado) {
            header("Location: formlugar.php");
            exit();
        } else {
            echo 'Error al intentar eliminar el lugar.';
        }
    }
?>
