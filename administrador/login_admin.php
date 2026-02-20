<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administracion</title>
    <link rel="stylesheet" href="../estilos/estilo_admin.css">
</head>
<body class="cuerpo-panel" style="display:flex; justify-content:center; align-items:center; height:100vh;">

    <div class="tarjeta" style="width:350px; flex-direction:column; padding:40px;">
        <h2 style="color:#34495e; text-align:center;">Administracion Juego</h2>
        
        <form action="procesar_login_admin.php" method="POST">
            <div style="margin-bottom:15px;">
                <label>Usuario:</label>
                <input type="text" name="usuario" required style="width:100%; padding:10px; border-radius:5px; border:1px solid #ddd;">
            </div>
            
            <div style="margin-bottom:20px;">
                <label>Contraseña:</label>
                <input type="password" name="clave" required style="width:100%; padding:10px; border-radius:5px; border:1px solid #ddd;">
            </div>
            
            <button type="submit" style="width:100%; background:#34495e; color:white; border:none; padding:12px; border-radius:5px; cursor:pointer;">
                ENTRAR
            </button>
        </form>

        <?php if(isset($_GET['error'])): ?>
            <p style="color:#e74c3c; text-align:center; margin-top:15px;"> Datos incorrectos</p>
        <?php endif; ?>
    </div>

</body>
</html>