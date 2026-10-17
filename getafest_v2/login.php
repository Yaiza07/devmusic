<?php
$error = "";
$valido= false;

if (isset($_POST['enviar'])) {
    $usuario = $_POST['usuario'];
    $contrasenna = $_POST['contrasenna'];

    if (file_exists("usuarios.txt")) {
        $lineas = file('usuarios.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lineas as $linea) {
            $partes = explode(":", $linea);
            if ($partes[0] == $usuario && $partes[1] == $contrasenna) {
                $valido = true;
                break;
            }
            if (!$valido) {
                $error = "Usuario o contraseña incorrectos";
            }
        }
    } else {
        $error ="Error: No existe el archivo usuarios.txt";
    }
}

if ($valido) {
    ?>
    <form method="post" action="index.php" id="paso">
        <input type="hidden" name="usuario" value="<?php echo $usuario; ?>">
        <noscript><input type="submit" value="continuar"></noscript>
    </form>
    <script>document.getElementById("paso").submit();</script>
    <?php
    exit;
}
include "header.php";
?>

<div class="card">
    <h2>Iniciar Sesión</h2>
    <?php if ($error != "") { echo "<p class='error'>" . $error . "</p>"; } ?>
    <form method="post">
        <div class="form-group">
            <label for="usuario">Usuario: </label>
            <input type="text" name="usuario" required placeholder="Ingresa tu usuario">
        </div>
        <div class="form-group">
            <label for="contrasenna">Contraseña: </label>
            <input type="password" name="contrasenna" required placeholder="Ingresa tu contraseña">
        </div>
        <input type="submit" class="btn" name="enviar" value="Entrar al Sistema">
    </form>
</div>