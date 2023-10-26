<?php
    // Incluye el archivo de configuración de la base de datos y la clase Jesuita
    require_once('config.php');
    require_once('jesuita.php');

    // Inicializa la conexión a la base de datos
    $db = new mysqli($db_host, $db_user, $db_pass, $db_name);

    if ($db->connect_error) {
        die("Error de conexión a la base de datos: " . $db->connect_error);
    }

    $jesuita = new Jesuita($db);

    $jesuitasList = $jesuita->listarJesuitas();

    // Procesar la solicitud para agregar un jesuita
    if (isset($_GET['agregarJesuita'])) {
        $idJesuita = $_GET['idJesuita'];
        $nombre = $_GET['nombre'];
        $firma = $_GET['firma'];

        if ($jesuita->agregarJesuita($idJesuita, $nombre, $firma)) { // Proporciona $idJesuita como tercer argumento
            echo "Jesuita agregado con éxito.";
        } else {
            echo "Error al agregar el Jesuita.";
        }
    }

    // Procesar la solicitud para modificar un jesuita
    if (isset($_GET['modificarJesuita'])) {
        $idJesuita = $_GET['idJesuita'];
        $nombre = $_GET['nombre'];
        $firma = $_GET['firma'];

        if ($jesuita->modificarJesuita($idJesuita, $nombre, $firma)) {
            echo "Jesuita modificado con éxito.";
        } else {
            echo "Error al modificar el Jesuita.";
        }
    }

    // Procesar la solicitud para borrar un jesuita
    if (isset($_GET['borrarJesuita'])) {
        $idJesuita = $_GET['idJesuita'];

        if ($jesuita->borrarJesuita($idJesuita)) {
            echo "Jesuita borrado con éxito.";
        } else {
            echo "Error al borrar el Jesuita.";
        }
    }


?>
<!DOCTYPE html>
<html>
    <head>
        <title>CRUD de Jesuitas</title>
        <link rel="stylesheet" type="text/css" href="./estilos/estilos.css">
    </head>
    <body>
        <h1>CRUD de Jesuitas</h1>     
        <h2>Agregar Jesuita</h2>
        <form method="get">
            <label>ID Jesuita:</label>
            <input type="text" name="idJesuita" required>
            <label>Nombre:</label>
            <input type="text" name="nombre" required>
            <label>Firma:</label>
            <input type="text" name="firma" required>
            <input type="submit" name="agregarJesuita" value="Agregar Jesuita">
        </form>       
        <h2>Modificar Jesuita</h2>
        <form method="get">
            <label>ID Jesuita:</label>
            <input type="text" name="idJesuita" required>
            <label>Nuevo Nombre:</label>
            <input type="text" name="nombre" required>
            <label>Nueva Firma:</label>
            <input type="text" name="firma" required>
            <input type="submit" name="modificarJesuita" value="Modificar Jesuita">
        </form>       
        <h2>Borrar Jesuita</h2>
        <form method="get">
            <label>ID Jesuita:</label>
            <input type="text" name="idJesuita" required>
            <input type="submit" name="borrarJesuita" value="Borrar Jesuita">
        </form>
        <h2>Listar Jesuitas</h2>
        <form method="get" action="listarjesuita.php">
            <input type="submit" name="listarJesuitas" value="Listar Jesuitas">
        </form>
        <h2>Volver al Índice</h2>
        <a href="index.html">Inicio</a>
    </body>
</html>

