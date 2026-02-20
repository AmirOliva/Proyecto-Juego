<?php
session_start();

$usuario_jefe = "admin";
$clave_jefe   = "1234";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_post = $_POST['usuario'];
    $pass_post = $_POST['clave'];

    if ($user_post === $usuario_jefe && $pass_post === $clave_jefe) {
        $_SESSION['jefe_conectado'] = true;
        $_SESSION['jefe_nombre'] = "Administrador";
        header("Location: admin.php");
        exit();
    } else {
        header("Location: login_admin.php?error=1");
        exit();
    }
} else {
    header("Location: login_admin.php");
    exit();
}
?>