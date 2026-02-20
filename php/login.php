<?php
session_start();
require_once "conexion.php";

$mensaje = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = trim($_POST["correo"]);
    $nombre = trim($_POST["nombre"]);

    if(empty($correo) || empty($nombre)) {
        $mensaje = "Todos los campos son obligatorios.";
    } else {
        $conexion = new Conexion();
        $db = $conexion->conectar();

        $sql = "SELECT * FROM usuarios WHERE correo = :correo AND nombre = :nombre";
        $stmt = $db->prepare($sql);
        $stmt->execute([":correo"=>$correo, ":nombre"=>$nombre]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if($usuario) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nombre'] = $usuario['nombre'];
            $_SESSION['usuario_apellido'] = $usuario['apellido'];
            header("Location: ../paginas/jugar.php");
            exit();
    }else {
            $mensaje = "Usuario no encontrado, revisa tus datos.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../estilos/style.css">
</head>
<body class="fondo">

<div class="caja">
    <h2>Iniciar Sesión</h2>
    <?php if($mensaje != ""): ?>
        <p class="texto"><?php echo $mensaje; ?></p>
    <?php endif; ?>
    <form method="POST">
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="email" name="correo" placeholder="Correo electrónico" required>
        <button type="submit" class="boton">Entrar</button>
    </form>
</div>

</body>
</html>