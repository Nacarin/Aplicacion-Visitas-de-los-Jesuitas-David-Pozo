<?php
    // Incluye el archivo de configuración de la base de datos y la clase Lugar
    require_once('../configuracion/config.php');
    require_once('../clases/lugar.php'); // Para formlugar.php
    

    // Inicializa la conexión a la base de datos
    $db = new mysqli($db_host, $db_user, $db_pass, $db_name);

    if ($db->connect_error) {
        die("Error de conexión a la base de datos: " . $db->connect_error);
    }

    $lugar = new Lugar($db);

    // Procesar la solicitud para agregar un lugar
    if (isset($_GET['agregarLugar'])) {
        $ip = $_GET['ip'];
        $lugarNombre = $_GET['lugar'];
        $descripcion = $_GET['descripcion'];

        if ($lugar->agregarLugar($ip, $lugarNombre, $descripcion)) {
            echo "Lugar agregado con éxito.";
        } else {
            echo "Error al agregar el Lugar.";
        }
    }

    // Procesar la solicitud para buscar un lugar por IP
    if (isset($_GET['buscarLugar'])) {
        $ip = $_GET['ip'];
        $lugarEncontrado = $lugar->buscarLugarPorIP($ip);
    
        if ($lugarEncontrado) {
            echo '<h2>Resultado de la búsqueda</h2>';
            echo '<p>IP: ' . $lugarEncontrado['ip'] . '</p>';
            echo '<p>Nombre del Lugar: ' . $lugarEncontrado['nombre'] . '</p>';
            echo '<p>Descripción: ' . $lugarEncontrado['descripcion'] . '</p>';
            echo '<a href="modificarlugar.php?ipModificar=' . $ip . '">Modificar Lugar</a>';
            echo '<a href="borrarlugar.php?ipBorrar=' . $ip . '">Borrar Lugar</a>';
        } else {
            echo 'No se encontró un Lugar con la IP proporcionada.';
        }
    }
    
?>


<!DOCTYPE html>
<html>
    <head>
        <title>CRUD de Lugares</title>
        <link rel="stylesheet" type="text/css" href="../estilos/estilos.css">
    </head>
    <body>
        <h1>CRUD de Lugares</h1>      
        <h2>Agregar Lugar</h2>
        <form method="get">
            <label>IP:</label>
            <input type="text" name="ip" required>
            <label>Nombre del Lugar:</label>
            <input type="text" name="lugar" required>
            <label>Descripción:</label>
            <input type="text" name="descripcion">
            <input type="submit" name="agregarLugar" value="Agregar Lugar">
        </form>      
<!--        <h2>Buscar Lugar por IP</h2>
        <form method="get">
            <label>IP:</label>
            <input type="text" name="ip" required>
            <input type="submit" name="buscarLugar" value="Buscar Lugar">
        </form>
-->        
        <h2>Buscar Lugar por IP y borrarlo</h2>
        <form method="get" action="borrarlugar.php">
            <label>IP:</label>
            <input type="text" name="ip" required>
            <input type="submit" name="borrarLugar" value="Buscar y Borrar Lugar">
        </form>

        <h2>Listar Lugares</h2>
        <form method="get" action="listarlugar.php">
            <input type="submit" name="listarLugares" value="Listar Lugares">
        </form>
        <h2>Volver al Índice</h2>
        <a href="../index.html">Inicio</a>
    </body>
</html>