<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cod_prove = $conn->real_escape_string($_POST['cod_prove']);
    $imagenActual = $conn->real_escape_string($_POST['logoprove']); //../assets/proveedores/3.png
    $nombre_prove = $conn->real_escape_string($_POST['nombre']);
    $telf_prove = $conn->real_escape_string($_POST['telf']);
    $correo_prove = $conn->real_escape_string($_POST['correo']);
    $direccion_prove = $conn->real_escape_string($_POST['direccion']);


    // Obtener imagen
    $img = $_FILES['logoprove']['tmp_name']; // Nombre temporal del archivo en el servidor, ej: "C:\xampp\tmp\php3F9.tmp"
    $nombreImg = $_FILES['logoprove']['name']; // Nombre original del archivo subido por el usuario, ej: "goku.jpg"
    $tipoImg = strtolower(pathinfo($nombreImg, PATHINFO_EXTENSION)); //jpg, jpeg, png
    $directorio = "../assets/proveedores/";


    if (!empty($img)) {

        try {
            unlink($imagenActual);
        } catch (\Throwable $th) {
            header("Location: ../views/proveedores.php?status=NoUpdatedprove");
        }

        if ($tipoImg == 'jpg' || $tipoImg == 'jpeg' || $tipoImg == 'png') {

            $ruta = $directorio . $cod_prove . "." . $tipoImg;

            if (move_uploaded_file($img, $ruta)) {

                $sql = "UPDATE proveedor SET 
                    nombre_prove = '$nombre_prove', 
                    telf_prove = '$telf_prove',
                    correo_prove = '$correo_prove',
                    direccion_prove = '$direccion_prove',
                    logo_prove = '$ruta'
                    WHERE cod_prove = $cod_prove";
            } else {
                header("Location: ../views/proveos.php?status=NoUpdatedprove");
                exit();
            }
        } else {
            header("Location: ../views/proveos.php?status=NoUpdatedprove");
            exit();
        }
    } else { //si la imagen es vacia, es decir que no se modificó, se subió tal cual como está, entonces se actualiza con la $imagenActual, ya que es la misma y se reemplaza por la misma.

        $sql = "UPDATE proveedor SET 
                    nombre_prove = '$nombre_prove', 
                    telf_prove = '$telf_prove',
                    correo_prove = '$correo_prove',
                    direccion_prove = '$direccion_prove',
                    logo_prove = '$imagenActual'
                    WHERE cod_prove = $cod_prove";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: ../views/proveedores.php?status=updatedProve");
        exit();
    } else {
        header("Location: ../views/proveedores.php?status=NoUpdatedProve");
        exit();
    }
}
