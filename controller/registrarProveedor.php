<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cod_prove = $conn->real_escape_string($_POST["RUC"]);
    $nombre_prove = $conn->real_escape_string($_POST['nombre']);
    $telf_prove = $conn->real_escape_string($_POST['telf']);
    $correo_prove = $conn->real_escape_string($_POST['correo']);
    $direccion_prove = $conn->real_escape_string($_POST['direccion']);
    $cod_tipo_client = $conn->real_escape_string($_POST["tipo-persona"]);
    $estado_prove = 1;

    //var_dump($cod_prove, $nombre_prove, $telf_prove, $correo_prove, $direccion_prove, $cod_tipo_client, $estado_prove);

    // Obtener imagen
    $img = $_FILES['fotoprove']['tmp_name'];
    $nombreImg = $_FILES['fotoprove']['name'];
    $tipoImg = strtolower(pathinfo($nombreImg, PATHINFO_EXTENSION));
    $directorio = "../assets/proveedores/";

    if ($tipoImg == 'jpg' || $tipoImg == 'jpeg' || $tipoImg == 'png') {

        // Insertar proveo
        $sql = "INSERT INTO proveedor (cod_prove, nombre_prove, telf_prove, correo_prove, direccion_prove, cod_tipo_client, estado_prove) 
                VALUES ('$cod_prove', '$nombre_prove', '$telf_prove', '$correo_prove', '$direccion_prove', $cod_tipo_client, $estado_prove)";

        if ($conn->query($sql) === TRUE) {

            $ruta = $directorio . $cod_prove . "." . $tipoImg;


            if (move_uploaded_file($img, $ruta)) {

                $actualizarImg = $conn->query("UPDATE proveedor SET logo_prove = '$ruta' WHERE cod_prove = $cod_prove");

                if ($actualizarImg) {
                    header("Location: ../views/proveedores.php?status=success");
                    exit();
                } else {
                    header("Location: ../views/proveedores.php?status=error");
                    exit();
                }
            } else {
                header("Location: ../views/proveedores.php?status=error");
                exit();
            }
        } else {
            header("Location: ../views/proveedores.php?status=error");
            exit();
        }
    }
}
?>
