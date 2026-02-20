<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>¿Cuánto sabes...?</title>
    <link rel="stylesheet" href="../estilos/style.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700;800&display=swap" rel="stylesheet">
</head>
<body class="body-index">

<div id="contenedorGeneral" class="contenedor-largo">

    <div id="columnaIzquierda" class="panel-largo glass">
        <h3 class="oro">🎮 MODO RETO</h3>
        <p>Bienvenido al desafío más grande de conocimiento. No es solo un juego, es una prueba de fuego para tu mente.</p> <div class="decoracion-panel">⭐ ⭐ ⭐</div> 
        <p>Compite contra otros usuarios y demuestra quién es el verdadero experto.</p>
    </div>

    <div id="columnaCentral" class="panel-central glass-dark">
        <div id="menu">
            <h1 class="titulo">¿Cuánto sabes...?</h1>
            
            <?php if(isset($_SESSION['usuario_nombre'])): ?>
                <div class="usuario">
                    👋 Hola, <strong><?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?></strong>
                </div>
                <a href="jugar.php"><button class="boton-menu btn-verde">🚀 JUGAR AHORA</button></a>
            <?php else: ?>
                <a href="jugar.php"><button class="boton-menu btn-verde">🚀 JUGAR</button></a>
                <button class="boton-menu btn-azul" onclick="window.location.href='../php/registro.php'">👤 REGISTRARSE</button>
            <?php endif; ?>
            
            <button id="btnInstrucciones" class="boton-menu btn-naranja">❓ INSTRUCCIONES</button>
        </div>
    </div>

    <div id="columnaDerecha" class="panel-largo glass">
        <h3 class="oro">📜 SISTEMA DE JUEGO</h3>
        <ul class="reglas">
            <li>❤️ <strong>3 VIDAS:</strong> Cada error resta una vida. Si llegas a 0, termina la partida.</li>
            <li>⏱️ <strong>TIEMPO:</strong> Dispones de 15 segundos para responder cada pregunta.</li>
            <li>⭐ <strong>PUNTOS:</strong> Cada respuesta correcta suma <strong>+10 puntos</strong>.</li>
            <li>🏆 <strong>RANKING:</strong> Solo las 10 mejores puntuaciones aparecen en la tabla de honor.</li>
        </ul>
        <hr style="border: 0; border-top: 1px solid rgba(255,255,255,0.1); margin: 15px 0;">
        <p style="font-size: 0.85em; text-align: left;">
            <strong>Tip:</strong> ¡Responde rápido para mantener la concentración y superar tu propio récord!
        </p>
    </div>

</div>

<script>
    document.getElementById("btnInstrucciones").onclick = () => {
        alert("Responde antes de que el tiempo se agote. ¡Tienes 3 vidas!");
    };
</script>

</body>
</html>