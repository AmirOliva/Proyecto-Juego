<?php 
session_start();

$conexion = mysqli_connect("localhost", "root", "", "juego");

if (!isset($_SESSION['jefe_conectado'])) {
    header("Location: login_admin.php");
    exit();
}

$ver_tabla = isset($_GET['ver']) ? $_GET['ver'] : '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Jefe</title>
    <link rel="stylesheet" href="../estilos/estilo_admin.css">
</head>
<body class="cuerpo-panel">

<div class="contenedor-dashboard">
    
    <aside class="barra-lateral">
        <div class="titulo-panel"><h2>MENU</h2></div>
        <nav class="menu-navegacion">
            <a href="admin.php">🏠 Inicio</a>
            <a href="admin.php?ver=usuarios">👥 Usuarios</a>
            <a href="admin.php?ver=ranking">🏆 Ranking (>60)</a>
            <a href="admin.php?ver=ranking_matematicas">📐 Matemáticas</a>
            <a href="admin.php?ver=ranking_historia">📜 Historia</a>
            <a href="admin.php?ver=ranking_banderas">🚩 Banderas</a>
            <a href="admin.php?ver=ranking_imagen">🖼️ Imagen</a>
            <hr style="opacity:0.1;">
            <a href="salir.php">🚪 Salir</a>
        </nav>
    </aside>

    <main class="contenido-principal">
        <header class="barra-superior">
            <h1>Panel del Jefe</h1>
            <p>Bienvenido, <?php echo $_SESSION['jefe_nombre']; ?> 👤</p>
        </header>

        <?php if ($ver_tabla == ''): ?>
            <div class="tarjeta">
                <h3>Bienvenido Jefe. Seleccione una opción del menú.</h3>
            </div>
        <?php endif; ?>

        <?php if ($ver_tabla == 'usuarios'): ?>
            <div class="tarjeta" style="display:block; padding:20px;">
                <h2 style="margin-bottom:20px;">Lista General de Usuarios</h2>
                <table border="1" style="width:100%; border-collapse: collapse;">
                    <tr style="background:#34495e; color:white;">
                        <th>Nombre</th><th>Apellido</th><th>Edad</th><th>Correo</th>
                    </tr>
                    <?php
                    $res = mysqli_query($conexion, "SELECT * FROM usuarios");
                    while ($fila = mysqli_fetch_assoc($res)) {
                        echo "<tr><td>".$fila['nombre']."</td><td>".$fila['apellido']."</td><td>".$fila['edad']."</td><td>".$fila['correo']."</td></tr>";
                    }
                    ?>
                </table>
            </div>
        <?php endif; ?>



        <?php if ($ver_tabla == 'ranking'): ?>
            <div class="tarjeta" style="display:block; padding:20px;">
                <h2 style="margin-bottom:20px;">🏆 Ranking: Mejores Puntuaciones (>60)</h2>
                <table border="1" style="width:100%; border-collapse: collapse; text-align: left;">
                    <tr style="background:#f1c40f; color:#2c3e50;">
                        <th style="padding:10px;">Nombre</th>
                        <th style="padding:10px;">Categoría</th>
                        <th style="padding:10px;">Puntos</th>
                    </tr>

                    <?php
                    $sql = "SELECT u.nombre, p.categoria, p.puntos 
                            FROM usuarios u
                            INNER JOIN puntaje p ON u.id = p.usuario_id 
                            WHERE p.puntos > 60 
                            ORDER BY p.puntos DESC";
                    
                    $res = mysqli_query($conexion, $sql);

                    if($res && mysqli_num_rows($res) > 0){
                        while ($fila = mysqli_fetch_assoc($res)) {
                            echo "<tr>";
                            echo "<td style='padding:10px;'>" . $fila['nombre'] . "</td>";
                            echo "<td style='padding:10px;'>" . $fila['categoria'] . "</td>";
                            echo "<td style='padding:10px; font-weight:bold; color:green;'>" . $fila['puntos'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3' style='padding:10px; text-align:center;'>No hay registros con más de 60 puntos.</td></tr>";
                    }
                    ?>
                </table>
            </div>
        <?php endif; ?>


        <?php 

        $tabla_db = "";
        if ($ver_tabla == 'ranking_matematicas') $tabla_db = 'ranking_matematicas';
        if ($ver_tabla == 'ranking_historia')    $tabla_db = 'ranking_historia';
        if ($ver_tabla == 'ranking_banderas')    $tabla_db = 'ranking_banderas';
        if ($ver_tabla == 'ranking_imagen')      $tabla_db = 'ranking_imagen';


        if ($tabla_db != ''): 
        ?>
    <div class="tarjeta" style="display:block; padding:20px;">
        <h2 style="margin-bottom:20px; text-transform: uppercase; color: #2c3e50;">
            🏆 <?php echo str_replace('_', ' ', $tabla_db); ?>
        </h2>
        <table border="1" style="width:100%; border-collapse: collapse; text-align: left;">
            <tr style="background:#2c3e50; color:white;">
                <th style="padding:10px;">ID</th>
                <th style="padding:10px;">Nombre</th>
                <th style="padding:10px;">Apellido</th>
                <th style="padding:10px;">Puntos Máximos</th>
            </tr>

            <?php
            $sql = "SELECT * FROM $tabla_db ORDER BY puntos_maximos DESC";
            $res = mysqli_query($conexion, $sql);

            if($res && mysqli_num_rows($res) > 0){
                while ($fila = mysqli_fetch_assoc($res)) {
                    echo "<tr>";
                    echo "<td style='padding:10px;'>" . $fila['id'] . "</td>";
                    echo "<td style='padding:10px;'>" . $fila['nombre_usuario'] . "</td>";
                    echo "<td style='padding:10px;'>" . $fila['apellido_usuario'] . "</td>";
                    echo "<td style='padding:10px; font-weight:bold; color: #27ae60;'>" . $fila['puntos_maximos'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4' style='padding:20px; text-align:center;'>No hay datos en esta tabla todavía.</td></tr>";
            }
            ?>
        </table>
    </div>
<?php endif; ?>

    </main>
</div>

</body>
</html>