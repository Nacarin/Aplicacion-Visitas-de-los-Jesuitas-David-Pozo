<?php
    // Incluye el archivo de configuración de la base de datos y la clase Jesuita
    require_once('../configuracion/config.php');
    require_once('../clases/jesuita.php'); // Para formjesuita.php

    $db = new mysqli($db_host, $db_user, $db_pass, $db_name);
    $jesuita = new Jesuita($db);
    

    if ($db->connect_error) {
        die("Error de conexión a la base de datos: " . $db->connect_error);
    }

    // Procesar la solicitud para buscar un Jesuita por ID
    if (isset($_GET['buscarJesuita'])) {
        $idJesuitaModificar = isset($_GET['idJesuitaModificar']) ? $_GET['idJesuitaModificar'] : null;
        $idJesuitaBuscar = $_GET['idJesuitaBuscar'];
        $jesuitaEncontrado = $jesuita->buscarJesuitaPorID($idJesuitaBuscar);

        echo '<h2>Resultado de la búsqueda</h2>';
        echo '<p>Nombre: ' . $jesuitaEncontrado['nombre'] . '</p>';
        echo '<p>Firma: ' . $jesuitaEncontrado['firma'] . '</p>';
    }
    
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Modificar Jesuita</title>
        <link rel="stylesheet" type="text/css" href="../estilos/estilos.css">
    </head>
    <body>
        <h2>Modificar Jesuita</h2>
        <form method="get">
            <label>ID Jesuita a Modificar: <?php echo $idJesuitaModificar; ?></label>
            <input type="hidden" name="idJesuitaModificar" value="<?php echo $idJesuitaModificar; ?>">
            <label>Nuevo Nombre:</label>
            <input type="text" name="nombre" value="<?php echo $jesuitaEncontrado['nombre']; ?>" required>
            <label>Nueva Firma:</label>
            <input type="text" name="firma" value="<?php echo $jesuitaEncontrado['firma']; ?>" required>
        <!--    <input type="submit" name="modificarJesuita" value="Modificar Jesuita"> -->
        </form>
    </body> 
</html>   

<?php
    // Procesar la solicitud para modificar el Jesuita
    if (isset($_GET['modificarJesuita'])) {
        
        $nombre = $_GET['nombre'];
        $firma = $_GET['firma'];

        if ($jesuita->modificarJesuita($idJesuitaModificar, $nombre, $firma)) {
            echo "Jesuita modificado con éxito.";
        } else {
            echo "Error al modificar el Jesuita.";
        }
    }
?>
