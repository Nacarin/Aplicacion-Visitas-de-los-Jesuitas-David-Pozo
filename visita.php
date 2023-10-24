<?php
    class Visita
    {
        private $db; // Representa la conexión a la base de datos

        public function __construct($db)
        {
            $this->db = $db; // Constructor que recibe la conexión a la base de datos
        }

        // Método para agregar una nueva Visita a la base de datos
        public function agregarVisita($idJesuita, $ip, $fechaHora)
        {
            // Construye la consulta SQL para insertar una nueva Visita
            $query = "INSERT INTO visita (idJesuita, ip, fechaHora) VALUES ($idJesuita, '$ip', NOW())";
        
            // Ejecuta la consulta SQL y verifica si se realizó con éxito
            if ($this->db->query($query)) {
                return true; // Éxito al agregar la Visita
            } else {
                return false; // Error al agregar la Visita
            }
        }

        // Método para borrar una Visita de la base de datos
        public function borrarVisita($idVisita)
        {
            $idVisita = (int)$idVisita;

            // Construye la consulta SQL para eliminar una Visita
            $query = "DELETE FROM visita WHERE idVisita = $idVisita";

            // Ejecuta la consulta SQL y verifica si se realizó con éxito
            if ($this->db->query($query)) {
                return true; // Éxito al borrar la Visita
            } else {
                return false; // Error al borrar la Visita
            }
        }
    }
?>