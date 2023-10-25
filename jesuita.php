<?php
    class Jesuita
    {
        private $db; // Representa la conexión a la base de datos

        public function __construct($db)
        {
            $this->db = $db; // Constructor que recibe la conexión a la base de datos
        }

        // Método para agregar un nuevo Jesuita a la base de datos
        public function agregarJesuita($idJesuita, $nombre, $firma)
        {

            // Construye la consulta SQL para insertar un nuevo Jesuita
            $query = "INSERT INTO jesuita (idJesuita, nombre, firma) VALUES ($idJesuita, '$nombre', '$firma')";

            // Ejecuta la consulta SQL y verifica si se realizó con éxito
            if ($this->db->query($query)) {
                return true; // Éxito al agregar el Jesuita
            } else {
                return false; // Error al agregar el Jesuita
            }
        }

        // Método para modificar un Jesuita existente en la base de datos
        public function modificarJesuita($idJesuita, $nombre, $firma)
        {
            // Convierte $idJesuita a un entero para garantizar que sea un número
            $idJesuita = (int)$idJesuita;

            // Construye la consulta SQL para actualizar el nombre y la firma del Jesuita
            $query = "UPDATE jesuita SET nombre = '$nombre', firma = '$firma' WHERE idJesuita = $idJesuita";

            // Ejecuta la consulta SQL y verifica si se realizó con éxito
            if ($this->db->query($query)) {
                return true; // Éxito al modificar el Jesuita
            } else {
                return false; // Error al modificar el Jesuita
            }
        }

        // Método para borrar un Jesuita de la base de datos
        public function borrarJesuita($idJesuita)
        {
            // Convierte $idJesuita a un entero para garantizar que sea un número
            $idJesuita = (int)$idJesuita;

            // Construye la consulta SQL para eliminar un Jesuita
            $query = "DELETE FROM jesuita WHERE idJesuita = $idJesuita";

            // Ejecuta la consulta SQL y verifica si se realizó con éxito
            if ($this->db->query($query)) {
                return true; // Éxito al borrar el Jesuita
            } else {
                return false; // Error al borrar el Jesuita
            }
        }

        public function listarJesuitas()
        {
            // Construye una consulta SQL para seleccionar los campos idJesuita, nombre y firma de la tabla "jesuita"
            $query = "SELECT idJesuita, nombre, firma FROM jesuita";
            
            // Ejecuta la consulta SQL en la base de datos
            $result = $this->db->query($query);
        
            if ($result && $result->num_rows > 0) {
                // Si la consulta se ejecutó con éxito y hay al menos una fila de resultado
                
                $jesuitas = []; // Inicializa un array vacío para almacenar los datos de los jesuitas
        
                // Itera a través de las filas de resultado
                while ($row = $result->fetch_assoc()) {
                    $jesuitas[] = $row; // Agrega los datos de cada jesuita al array de jesuitas
                }
        
                return $jesuitas; // Retorna un array de jesuitas
            } else {
                return []; // Retorna un array vacío si no hay jesuitas en la base de datos
            }
        }
        
    }
?>