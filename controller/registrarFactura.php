<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $total_fact = $conn->real_escape_string($_POST["totalVenta"]);
    $recibido_fact = $conn->real_escape_string($_POST["totalRecibido"]);
    $vuelto_fact = $conn->real_escape_string($_POST["vuelto"]);
    $cod_client = $conn->real_escape_string($_POST["cedulaCliente"]);
    $cod_vend = $conn->real_escape_string($_POST["cedulaVendedor"]);

    // Insertar factura
    $sqlFactura = "INSERT INTO factura (total_fact, recibido_fact, vuelto_fact, cod_client, cod_vend) 
                   VALUES ($total_fact, $recibido_fact, $vuelto_fact, '$cod_client', '$cod_vend')";

    if ($conn->query($sqlFactura) === TRUE) {
        $cod_fact = $conn->insert_id; // ID de factura

        // Recibir productos
        $productos = json_decode($_POST['productos'], true);

        foreach ($productos as $producto) {
            $cod_product = $conn->real_escape_string($producto['id']);
            $cantidad = (int)$conn->real_escape_string($producto['cantidad']);

            // Obtener el precio y descuento desde la BD
            $sqlProd = "SELECT precio_product, descuento_product FROM producto WHERE cod_product = '$cod_product'";
            $resProd = $conn->query($sqlProd);

            if ($resProd && $rowProd = $resProd->fetch_assoc()) {
                $precio = (float)$rowProd['precio_product']; 
                $descuento = (float)$rowProd['descuento_product']; // porcentaje

                // Calcular subtotal
                $subtotal_base = $precio * $cantidad;
                $monto_descuento = $subtotal_base * ($descuento / 100);
                $subtotal_con_descuento = $subtotal_base - $monto_descuento;

                // IVA del 15%
                $iva = $subtotal_con_descuento * 0.15;
                $subtotal_final = $subtotal_con_descuento + $iva;

            } else {
                $subtotal_final = 0; // fallback en caso de error
            }

            // Insertar en detalle_factura
            $sqlDetalle = "INSERT INTO detalle_factura (cant_detalle, total_detalle, cod_product, cod_fact) 
                           VALUES ($cantidad, $subtotal_final, '$cod_product', $cod_fact)";
            $conn->query($sqlDetalle);

            // Insertar en detalle_factura_temp
            $sqlDetalleTemp = "INSERT INTO detalle_factura_temp (cant_detalle, total_detalle, cod_product, cod_fact) 
                           VALUES ($cantidad, $subtotal_final, '$cod_product', $cod_fact)";
            $conn->query($sqlDetalleTemp);

            // Actualizar stock
            $sqlUpdateStock = "UPDATE producto 
                               SET stock_product = stock_product - $cantidad 
                               WHERE cod_product = '$cod_product'";
            $conn->query($sqlUpdateStock);

            // Verificar si el stock es exactamente 0
            $sqlCheckStock = "SELECT stock_product FROM producto WHERE cod_product = '$cod_product'";
            $result = $conn->query($sqlCheckStock);

            if ($result && $row = $result->fetch_assoc()) {
                if ((int)$row['stock_product'] === 0) {
                    $sqlInactivar = "UPDATE producto 
                                     SET estado_product = 0 
                                     WHERE cod_product = '$cod_product'";
                    $conn->query($sqlInactivar);
                }
            }
        }

        header("Location: ../views/facturacion.php?status=success");
    } else {
        header("Location: ../views/facturacion.php?status=error");
    }

    $conn->close();
}
?>
