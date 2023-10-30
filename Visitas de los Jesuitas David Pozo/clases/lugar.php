<?php
    class Lugar
    {
        private $db; // Representa la conexión a la base de datos

        public function __construct($db)
        {
            $this->db = $db; // Constructor que recibe la conexión a la base de datos
        }

        // Método para agregar un nuevo Lugar a la base de datos
        public function agregarLugar($ip, $lugar, $descripcion)
        {
            // Construye la consulta SQL para insertar un nuevo Lugar
            $query = "INSERT INTO lugar (ip, lugar, descripcion) VALUES ('$ip', '$lugar', '$descripcion')";

            // Ejecuta la consulta SQL y verifica si se realizó con éxito
            if ($this->db->query($query)) {
                return true; // Éxito al agregar el Lugar
            } else {
                return false; // Error al agregar el Lugar
            }
        }

        // Método para modificar un Lugar existente en la base de datos
        public function modificarLugar($ip, $lugar, $descripcion)
        {
            // Construye la consulta SQL para actualizar el nombre del Lugar y su descripción
            $query = "UPDATE lugar SET lugar = '$lugar', descripcion = '$descripcion' WHERE ip = '$ip'";

            // Ejecuta la consulta SQL y verifica si se realizó con éxito
            if ($this->db->query($query)) {
                return true; // Éxito al modificar el Lugar
            } else {
                return false; // Error al modificar el Lugar
            }
        }

        // Método para borrar un Lugar de la base de datos
        public function borrarLugar($ip)
        {
            // Construye la consulta SQL para eliminar un Lugar
            $query = "DELETE FROM lugar WHERE ip = '$ip'";

            // Ejecuta la consulta SQL y verifica si se realizó con éxito
            if ($this->db->query($query)) {
                return true; // Éxito al borrar el Lugar
            } else {
                return false; // Error al borrar el Lugar
            }
        }

        public function listarLugares()
        {
            // Define la consulta SQL para seleccionar todos los campos de la tabla 'lugar'
            $query = "SELECT ip, lugar, descripcion FROM lugar";
            
            // Ejecuta la consulta SQL y almacena el resultado en la variable $result
            $result = $this->db->query($query);
        
            if ($result && $result->num_rows > 0) {
                // Si la consulta se ejecuta con éxito y devuelve una o más filas de datos
                
                // Crea un array vacío llamado $lugares para almacenar los datos de los lugares
                $lugares = [];
                
                // Itera a través de las filas de datos obtenidas
                while ($row = $result->fetch_assoc()) {
                    // Agrega cada fila como un elemento al array $lugares
                    $lugares[] = $row;
                }
                
                // Retorna el array $lugares que contiene la lista de lugares
                return $lugares;
            } else {
                // Si la consulta no devuelve resultados, se retorna un array vacío
                return [];
            }
        }

        //Si vamos a borrar un Lugar primero miraremos  si tiene visitas asociadas
        public function contarVisitasPorLugar($idLugar) {
            $query = "SELECT COUNT(*) as total_visitas FROM visita WHERE idLugar = $idLugar";
    
            $result = $this->db->query($query);
            if ($result) {
                $row = $result->fetch_assoc();
                return $row['total_visitas'];
            } else {
                return 0;
            }
        }

        public function buscarLugarPorIP($ip)
        {
            // Consulta SQL para buscar un lugar por su IP
            $query = "SELECT ip, lugar, descripcion FROM lugar WHERE ip = '$ip'";
            
            // Ejecutar la consulta y obtener el resultado
            $result = $this->db->query($query);
    
            if ($result && $result->num_rows > 0) {
                return $result->fetch_assoc(); // Retorna los datos del lugar
            } else {
                return null; // Si no se encuentra el lugar, se devuelve null
            }
        }

               
    }
?>