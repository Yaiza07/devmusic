<?php
$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
include "header.php";

$reservas = [];

if (file_exists("reservas.txt")) {
    $reservas = file("reservas.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
}

?>

<div class="card tabla-card">
    <div class="cabecera-tabla">
        <h2>Listado de reservas</h2>
        <form method="post" action="index.php">
            <input type="hidden" name="usuario" value="<?php echo htmlspecialchars($usuario); ?>">
            <button type="submit" class="btn">+ Nueva Reserva</button>
        </form>
    </div>
    <?php if (count($reservas) == 0) { ?>
        <p>No hay reservas todavía.</p>
    <?php } else { ?>
        <table class="tabla-reservas">
            <thead>
            <tr>
                <th>Fecha</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Edad</th>
                <th>Pase</th>
                <th>Pago</th>
                <th>Total</th>
                <th>Acción Admin</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $id = 0;
            foreach ($reservas as $dato) {
                $campos = explode("|", $dato);
                $id++;
                ?>
                <tr>
                    <td><?php echo $campos[0]; ?> </td>
                    <td><?php echo $campos[1]; ?> </td>
                    <td><?php echo $campos[2]; ?> </td>
                    <td><?php echo $campos[3]; ?> </td>
                    <td><?php echo $campos[4]; ?> </td>
                    <td><?php echo $campos[6]; ?> </td>
                    <td><?php echo $campos[7]; ?> </td>
                    <td>
                        <form method="post" action="ver_pase.php">
                            <input type="hidden" name="usuario" value="<?php echo htmlspecialchars($usuario); ?>">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <button type="submit" class="btn-pase">Ver Pase</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    <?php } ?>
</div>