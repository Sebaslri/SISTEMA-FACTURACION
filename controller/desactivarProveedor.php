<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cod_product = $conn->real_escape_string($_POST['cod_product']);
    $imagenActual = $conn->real_escape_string($_POST['foto_product']); //../assets/productos/3.png
    $nombre_product = $conn->real_escape_string($_POST['nombre']);
    $stock_product = $_POST['stock'] !== "" ? floatval($_POST['stock']) : 0;
    $precio_product = floatval(str_replace(',', '.', $_POST['precio']));
    $descuento_product = floatval(str_replace(',', '.', $_POST['descuento']));
    $descuento_product = $conn->real_escape_string($_POST['descuento']);
    $cod_prove = $conn->real_escape_string($_POST['proveedor']);

    // Obtener imagen
    $img = $_FILES['fotoproducto']['tmp_name'];// Nombre temporal del archivo en el servidor, ej: "C:\xampp\tmp\php3F9.tmp"
    $nombreImg = $_FILES['fotoproducto']['name'];// Nombre original del archivo subido por el usuario, ej: "goku.jpg"
    $tipoImg = strtolower(pathinfo($nombreImg, PATHINFO_EXTENSION)); //jpg, jpeg, png
    $directorio = "../assets/productos/";


    if (!empty($img)) { 

        try {
            unlink($imagenActual);
        } catch (\Throwable $th) {
            header("Location: ../views/productos.php?status=NoUpdatedProduct");
        }

        if ($tipoImg == 'jpg' || $tipoImg == 'jpeg' || $tipoImg == 'png') {

            $ruta = $directorio . $cod_product . "." . $tipoImg;

            if (move_uploaded_file($img, $ruta)) {

                $sql = "UPDATE producto SET 
                    nombre_product = '$nombre_product', 
                    stock_product = $stock_product,
                    precio_product = $precio_product,
                    descuento_product = $descuento_product,
                    cod_prove = '$cod_prove',
                    foto_product = '$ruta'
                    WHERE cod_product = $cod_product";
            } else {
                header("Location: ../views/productos.php?status=NoUpdatedProduct");
                exit();
            }
        } else {
            header("Location: ../views/productos.php?status=NoUpdatedProduct");
            exit();
        }
    } else {//si la imagen es vacia, es decir que no se modificó, se subió tal cual como está, entonces se actualiza con la $imagenActual, ya que es la misma y se reemplaza por la misma.
        
         $sql = "UPDATE producto SET 
                    nombre_product = '$nombre_product', 
                    stock_product = $stock_product,
                    precio_product = $precio_product,
                    descuento_product = $descuento_product,
                    cod_prove = '$cod_prove',
                    foto_product = '$imagenActual'
                    WHERE cod_product = $cod_product";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: ../views/productos.php?status=updatedProduct");
        exit();
    } else {
        header("Location: ../views/productos.php?status=NoUpdatedProduct");
        exit();
    }
}
