<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cod_vend = $conn->real_escape_string($_POST["cedula"]);
    $nombre_vend = $conn->real_escape_string($_POST['nombre']);
    $apellido_vend = $conn->real_escape_string($_POST['apellido']);
    $telf_vend = $conn->real_escape_string($_POST['telf']);
    $correo_vend = $conn->real_escape_string($_POST['correo']);
    $direccion_vend = $conn->real_escape_string($_POST['direccion']);
    $cod_canton = $conn->real_escape_string($_POST['canton']);
    $estado_vend = 1;


    $sql = "INSERT INTO vendedor (cod_vend, nombre_vend, apellido_vend, telf_vend, correo_vend,
    direccion_vend, estado_vend, cod_canton) VALUES ('$cod_vend', '$nombre_vend', '$apellido_vend', 
    '$telf_vend', '$correo_vend', '$direccion_vend', $estado_vend, '$cod_canton')";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../views/vendedores.php?status=success");
    } else  {
        header("Location: ../views/vendedores.php?status=error");
    }

    $conn->close();
}
?>
