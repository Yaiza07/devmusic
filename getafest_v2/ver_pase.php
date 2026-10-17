<?php
include "header.php";

$usuario = isset($_POST["usuario"]) ? $_POST["usuario"] : "";
$id = isset($_POST["id"]);

if ($usuario != "admin") {
    echo "<div class='card'><div class='error'>Acceso denegado: solo el administrador puede ver esta página.</div></div>";
    echo "</body></html>";
    exit;
}

$reservas = [];
if (file_exists("reservas.txt")) {
    $reservas = file("reservas.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
}

if ($id < 1 || $id > count($reservas)) {
    echo "<div class='card'><div class='error'>La reserva no existe.</div></div>";
    echo "</body></html>";
    exit;
}

$campos = explode("|", $reservas[$id - 1]);
?>

<div class="card">
    <h2>Acreditación #<?php echo $id; ?> (Vista Administrador)</h2>

    <div class="card profile-card">
        <img class="foto-perfil" src="<?php echo$campos[8]; ?>">
        <h3><?php echo $campos[1]; ?></h3>
        <p><strong>Email: </strong><?php echo $campos[2]; ?></p>
        <p><strong>Edad: </strong><?php echo $campos[3]; ?> años</p>
        <p><strong>Tipo de Entrada: </strong><?php echo $campos[4]; ?></p>
        <p><strong>Días de asistencia: </strong><?php echo $campos[5]; ?></p>
        <p><strong>Método de pago: </strong><?php echo $campos[6]; ?></p>
        <p><em>"<?php echo $campos[9]; ?>"</em></p>
        <h2>Total: <?php echo $campos[7]; ?></h2>
    </div>

    <form method="post" action="ver_reservas.php">
        <input type="hidden" name="usuario" value="<?php echo $usuario; ?>">
        <button type="submit" class="btn-volver">← Volver al listado de reservas</button>
    </form>
</div>
