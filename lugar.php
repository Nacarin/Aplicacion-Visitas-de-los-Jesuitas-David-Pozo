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
    }
?>