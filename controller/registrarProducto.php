<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_product = $conn->real_escape_string($_POST['nombre']);
    $stock_product = $conn->real_escape_string($_POST['stock']);
    $precio_product = $conn->real_escape_string($_POST['precio']);
    $descuento_product = $conn->real_escape_string($_POST['descuento']);
    $cod_cate = $conn->real_escape_string($_POST['categoria']);
    $cod_prove = $conn->real_escape_string($_POST['proveedor']);
    $estado_product = 1;

    // Obtener imagen
    $img = $_FILES['fotoproducto']['tmp_name'];
    $nombreImg = $_FILES['fotoproducto']['name'];
    $tipoImg = strtolower(pathinfo($nombreImg, PATHINFO_EXTENSION));
    $directorio = "../assets/productos/";

    if ($tipoImg == 'jpg' || $tipoImg == 'jpeg' || $tipoImg == 'png') {

        // Insertar producto
        $sql = "INSERT INTO producto (nombre_product, stock_product, precio_product, descuento_product, cod_cate, cod_prove, estado_product) 
                VALUES ('$nombre_product', $stock_product, $precio_product, $descuento_product, '$cod_cate', '$cod_prove', $estado_product)";

        if ($conn->query($sql) === TRUE) {

            $idRegistro = $conn->insert_id;
            $ruta = $directorio . $idRegistro . "." . $tipoImg;


            if (move_uploaded_file($img, $ruta)) {

                $actualizarImg = $conn->query("UPDATE producto SET foto_product = '$ruta' WHERE cod_product = $idRegistro");

                if ($actualizarImg) {
                    header("Location: ../views/productos.php?status=success");
                    exit();
                } else {
                    header("Location: ../views/productos.php?status=error");
                    exit();
                }
            } else {
                header("Location: ../views/productos.php?status=error");
                exit();
            }
        } else {
            header("Location: ../views/productos.php?status=error");
            exit();
        }
    }
}
?>
