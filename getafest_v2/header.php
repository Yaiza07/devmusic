<?php
$usuarioActivo = "";
if (isset($_POST["usuario"]) && !isset($_POST["login"])) {
    $usuarioActivo = trim($_POST["usuario"]);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>DEVMUSIC FEST 2026 - Acreditaciones</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
    <h1>DEVMUSIC FEST 2026</h1>
    <p>Sistema Oficial de Reserva y Acreditación Digital</p>
    <?php if ($usuarioActivo != "") { ?>
        <p>Usuario activo: <strong><?php echo $usuarioActivo; ?></strong>
            <a href="login.php">Cerrar Sesión / Salir</a></p>
    <?php } else { ?>
        <p>Acceso al portal: <a href="login.php">🔑 Iniciar Sesión</a></p>
    <?php } ?>
</header>