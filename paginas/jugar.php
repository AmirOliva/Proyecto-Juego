<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../php/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>¿Cuánto sabes...? - Juego</title>
    <link rel="stylesheet" href="../estilos/style.css">
    <link rel="stylesheet" href="../estilos/categoria.css">
</head>
<body class="fondo-jugar">

<div id="contenedorJuego">

    <div id="categorias">
        <h2>Elige una categoría <?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?></h2>
        <button class="cat" data-cat="mates">➗ Matemáticas</button>
        <button class="cat" data-cat="historia">📜 Historia (V/F)</button>
        <button class="cat" data-cat="banderas">🚩 Banderas</button>
        <button class="cat" data-cat="imagen">🖼️ Adivina la imagen</button>
    </div>
<div id="barraUsuario" style="display: flex; justify-content: space-between; align-items: center; padding: 10px; border-radius: 10px; margin-top: 40px;">
        <a href="../php/logout.php" class="boton-salir" style="background: #ff4757; color: white; padding: 8px 15px; border-radius: 5px; text-decoration: none; font-size: 0.9em; font-weight: bold;">
            Cerrar Sesión
        </a>
    </div>
    <div id="juego" style="display:none;">
        <div id="barraSuperior">
            <div id="zonaVidas">
                <div id="vidas">❤️❤️❤️</div>
                <div id="puntos">⭐ 0</div>
            </div>
            <div id="pregunta"></div>
            <img id="imagenBandera" style="display:none; max-width:250px; border-radius:15px;">
            <div id="tiempo">⏱️ 15</div>
        </div>

        <div id="respuestas">
            <button class="opcion"></button>
            <button class="opcion"></button>
            <button class="opcion"></button>
            <button class="opcion"></button>
        </div>
    </div>

</div>

<script src="../script/script.js"></script>
</body>
</html>