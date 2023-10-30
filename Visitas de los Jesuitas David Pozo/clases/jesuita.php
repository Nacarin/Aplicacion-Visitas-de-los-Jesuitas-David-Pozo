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

        // Método para buscar un Jesuita de la base de datos
        public function buscarJesuitaPorID($idJesuita)
        {
            $idJesuita = (int)$idJesuita;

            $query = "SELECT nombre, firma FROM jesuita WHERE idJesuita = $idJesuita";
            $result = $this->db->query($query);

            if ($result && $result->num_rows == 1) {
                return $result->fetch_assoc();
            } else {
                return null; // Retorna null si no se encuentra el Jesuita
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

        //Si vamos a borrar un Jesuita primero miraremos  si tiene visitas asociadas
        public function contarVisitasPorJesuita($idJesuita) {
            $query = "SELECT COUNT(*) as total_visitas FROM visita WHERE idJesuita = $idJesuita";
    
            $result = $this->db->query($query);
            if ($result) {
                $row = $result->fetch_assoc();
                return $row['total_visitas'];
            } else {
                return 0;
            }
        }
        
    }
?>