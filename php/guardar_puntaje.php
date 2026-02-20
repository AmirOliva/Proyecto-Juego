<?php
session_start();
require_once "conexion.php";

if(!isset($_SESSION['usuario_id'])){
    echo "Error: no hay usuario logueado";
    exit();
}

$usuario_id = $_SESSION['usuario_id'];
$nombre = $_SESSION['usuario_nombre']; 
$apellido = isset($_SESSION['usuario_apellido']) ? $_SESSION['usuario_apellido'] : ''; 
$puntos = isset($_POST['puntos']) ? (int)$_POST['puntos'] : 0;
$categoria = isset($_POST['categoria']) ? $_POST['categoria'] : null;

if($puntos >= 0 && $categoria){
    $conexion = new Conexion();
    $db = $conexion->conectar();

    $sqlPuntaje = "INSERT INTO puntaje (usuario_id, puntos, categoria) VALUES (:uid, :pts, :cat)";
    $db->prepare($sqlPuntaje)->execute([":uid" => $usuario_id, ":pts" => $puntos, ":cat" => $categoria]);

    $tablaRanking = "";
    switch($categoria) {
        case "mates":    $tablaRanking = "ranking_matematicas"; break;
        case "historia": $tablaRanking = "ranking_historia"; break;
        case "banderas": $tablaRanking = "ranking_banderas"; break;
        case "imagen":   $tablaRanking = "ranking_imagen"; break;
    }

    if($tablaRanking != ""){
        $sqlBusqueda = "SELECT puntos_maximos FROM $tablaRanking WHERE usuario_id = :uid";
        $stmtBusca = $db->prepare($sqlBusqueda);
        $stmtBusca->execute([":uid" => $usuario_id]);
        $recordActual = $stmtBusca->fetch(PDO::FETCH_ASSOC);

        if(!$recordActual) {
            // Si es su primera vez en esta categoría, insertamos
            $sqlInsert = "INSERT INTO $tablaRanking (usuario_id, nombre_usuario, apellido_usuario, puntos_maximos) 
                          VALUES (:uid, :nom, :ape, :pts)";
            $db->prepare($sqlInsert)->execute([
                ":uid" => $usuario_id, ":nom" => $nombre, ":ape" => $apellido, ":pts" => $puntos
            ]);
        } else if($puntos > $recordActual['puntos_maximos']) {
            // Si superó su récord, actualizamos
            $sqlUpdate = "UPDATE $tablaRanking SET puntos_maximos = :pts WHERE usuario_id = :uid";
            $db->prepare($sqlUpdate)->execute([":pts" => $puntos, ":uid" => $usuario_id]);
        }
    }

    echo "Puntaje guardado en historial y actualizado en $tablaRanking";
} else {
    echo "Datos insuficientes para guardar";
}
?>