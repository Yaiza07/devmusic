<?php
if (!isset($_POST["enviar"])) {
    echo "Acceso no permitido";
    exit;
}

include "header.php";
$foto = $_FILES["foto"];
if ($foto["error"] == 0) {
    if ($foto["type"] == "image/jpg" || $foto["type"] == "image/jpeg" || $foto["type"] == "image/png") {

    } else {
        echo "Formato de imagen incorrecto";
        exit;
    }
} else {
    echo "Debes seleccionar una imagen";
    exit;
}
$nombre = $_POST['nombre'];
$email = $_POST['email'];
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "El email no tiene un formato válido";
    exit;
}
$edad = $_POST['edad'];
if ($edad < 18) {
    echo "La edad no puede ser menor a 18";
    exit;
}
$tipo = $_POST['tipo'];
$dias = $_POST['dias'];
$metodo = $_POST['metodo'];
if (!empty($_POST["comentario"])) {
    $comentario = $_POST["comentario"];
} else {
    $comentario = "*Nada que decir*";
}

$total = 0;

if ($tipo == "General") {
    $total = 50;
} elseif ($tipo == "VIP") {
    $total = 120;
} elseif ($tipo == "SuperVIP") {
    $total = 180;
}

foreach ($dias as $dia) {
    $total = $total + 10;
}
$extension = "";
if ($foto["type"] == "image/png") {
    $extension = "png";
} else {
    $extension = "jpg";
}

$fechaHora = date("Y-m-d H:i:s");
$diasTexto = implode(",", $dias);
$rutaFoto = "images/" . uniqid() . "." . $extension;
move_uploaded_file($foto["tmp_name"], $rutaFoto);
$texto = $fechaHora . "|" . $nombre . "|" . $email . "|" . $edad . "|" . $tipo . "|" . $diasTexto . "|" . $metodo . "|" . $total . "€|" . $rutaFoto . "|" . $comentario . "\n";

file_put_contents("reservas.txt", $texto, FILE_APPEND);
?>


<div class="card profile-card">
    <img class="foto-perfil" src="<?php echo $rutaFoto; ?>" alt="Foto de <?php echo $nombre; ?>">
    <h3><?php echo $nombre; ?></h3>
    <p><strong>Email: </strong><?php echo $email ?></p>
    <p><strong>Tipo de entrada: </strong><?php echo $tipo ?></p>
    <p><strong>Días de asistencia: </strong>
        <?php
        $contador = 0;
        foreach ($dias as $dia) {
            echo $dia;
            $contador++;
            if ($contador < count($dias)) {
                echo ",";
            }
        }
        ?>
    </p>
    <p><strong>Método de pago: </strong><?php echo $metodo ?></p>
    <p><?php echo $comentario ?></p>
    <h2>Total pagado: <?php echo $total ?> €</h2>
</div>
<a href="index.php" class="otra-reserva">⬅️ Realizar otra reserva</a>