<?php
require_once "conexion.php";

$mensaje = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = trim($_POST["nombre"]);
    $apellido = trim($_POST["apellido"]);
    $edad = trim($_POST["edad"]);
    $correo = trim($_POST["correo"]);

    if(empty($nombre) || empty($apellido) || empty($edad) || empty($correo)) {
        $mensaje = "Todos los campos son obligatorios.";
    } else {

        $conexion = new Conexion();
        $db = $conexion->conectar();

        $sql = "INSERT INTO usuarios (nombre, apellido, edad, correo)
                VALUES (:nombre, :apellido, :edad, :correo)";

        $stmt = $db->prepare($sql);

        try {
            $stmt->execute([
                ":nombre" => $nombre,
                ":apellido" => $apellido,
                ":edad" => $edad,
                ":correo" => $correo
            ]);

            header("Location: ../paginas/index.php");
            exit();

        } catch(PDOException $e) {
            $mensaje = "Error: el correo ya está registrado.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="stylesheet" href="../estilos/style.css">
</head>
<body class="fondo">

<div class="caja">
    <h2>Crear Cuenta</h2>

    <?php if($mensaje != ""): ?>
        <p class="texto"><?php echo $mensaje; ?></p>
    <?php endif; ?>

    <form method="POST">
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="text" name="apellido" placeholder="Apellido" required>
        <input type="number" name="edad" placeholder="Edad" min="1" required>
        <input type="email" name="correo" placeholder="Correo electrónico" required>
        <button type="submit" class="boton">Registrarme</button>
    </form>
</div>

</body>
</html>