<?php
    require_once('../configuracion/config.php');
    require_once('../clases/jesuita.php');

    $db = new mysqli($db_host, $db_user, $db_pass, $db_name);
    $jesuita = new Jesuita($db);

    if ($db->connect_error) {
        die("Error de conexión a la base de datos: " . $db->connect_error);
    }

    if (isset($_GET['idJesuita'])) {
        $idJesuita = $_GET['idJesuita'];
        $jesuitaEncontrado = $jesuita->buscarJesuitaPorID($idJesuita);

        if ($jesuitaEncontrado) {
            // Verificar si el Jesuita tiene visitas asociadas
            $visitasAsociadas = $jesuita->contarVisitasPorJesuita($idJesuita);

            if ($visitasAsociadas > 0) {
                // Jesuita tiene visitas asociadas
                echo '<h2>El Jesuita no puede ser borrado</h2>';
                echo '<p>Este Jesuita tiene visitas asociadas y no puede ser eliminado.</p>';
                echo '<a href="formjesuita.php">Volver a Form Jesuita</a>';
            } else {
                // Jesuita no tiene visitas asociadas
                echo '<h2>Detalles del Jesuita a borrar</h2>';
                echo '<p>Nombre: ' . $jesuitaEncontrado['nombre'] . '</p>';
                echo '<p>Firma: ' . $jesuitaEncontrado['firma'] . '</p>';

                echo '
                <form method="get">
                    <input type="hidden" name="idJesuita" value="' . $idJesuita . '">
                    <input type="submit" name="confirmarBorrarJesuita" value="Confirmar borrado">
                </form>';

                if (isset($_GET['confirmarBorrarJesuita'])) {
                    if ($jesuita->borrarJesuita($idJesuita)) {
                        echo "Jesuita borrado con éxito.";
                        header("Location: formjesuita.php");
                        exit();
                    } else {
                        echo "Error al borrar el Jesuita.";
                    }
                }
            }
        } else {
            echo 'No se encontró un Jesuita con el ID proporcionado.';
        }
    } else {
        echo 'No se proporcionó un ID de Jesuita.';
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Borrar Jesuita</title>
        <link rel="stylesheet" type="text/css" href="../estilos/estilos.css">
    </head>
    <body>
        <br/>
        <a href="./formjesuita.php">Jesuitas</a>
    </body>
</html>


