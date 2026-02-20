<?php
class Conexion {
    private $host = "localhost";
    private $db = "juego";
    private $usuario = "root"; // Cambia si tu usuario es otro
    private $pass = "";        // Cambia si tu contraseña no es vacía
    private $conexion;

    public function conectar() {
        try {
            $this->conexion = new PDO(
                "mysql:host={$this->host};dbname={$this->db};charset=utf8",
                $this->usuario,
                $this->pass
            );
            // Modo de errores
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conexion;
        } catch(PDOException $e) {
            die("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }
}
?>