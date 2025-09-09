<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cod_vend = $conn->real_escape_string($_POST["cod_vend"]);
    $nombre_vend = $conn->real_escape_string($_POST['nombre']);
    $apellido_vend = $conn->real_escape_string($_POST['apellido']);
    $telf_vend = $conn->real_escape_string($_POST['telf']);
    $correo_vend = $conn->real_escape_string($_POST['correo']);
    $direccion_vend = $conn->real_escape_string($_POST['direccion']);
    $cod_canton = $conn->real_escape_string($_POST['cantonedit']);

    $sql = "UPDATE vendedor SET 
        nombre_vend = '$nombre_vend',
        apellido_vend = '$apellido_vend',
        telf_vend = '$telf_vend',
        correo_vend = '$correo_vend',
        direccion_vend = '$direccion_vend',
        cod_canton = '$cod_canton'
        WHERE cod_vend = '$cod_vend'";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../views/vendedores.php?status=updatedVendor");
    } else {
        header("Location: ../views/vendedores.php?status=NoUpdatedVendor");
    }

    $conn->close();
}
?>
