<?php
include '../controller/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cantidadDevuelta'])) {

    $cantidades = $_POST['cantidadDevuelta'];
    $motivos = $_POST['motivoDevolucion']; 

    foreach ($cantidades as $cod_detalle => $cant_devo) {
        $cant_devo = (int)$cant_devo;

        if ($cant_devo > 0) {
            // Obtener datos originales
            $sql = "SELECT cant_detalle, cod_product FROM detalle_factura_temp WHERE cod_detalle = '$cod_detalle'";
            $result = $conn->query($sql);

            if ($result && $row = $result->fetch_assoc()) {
                $cant_actual = (int)$row['cant_detalle'];
                $cod_product = $row['cod_product'];

                // Validar que no se devuelva más de lo facturado
                if ($cant_devo <= $cant_actual) {
                    $motivo = isset($motivos[$cod_detalle]) ? $conn->real_escape_string($motivos[$cod_detalle]) : '';

                    // Obtener precio y descuento del producto
                    $sqlProd = "SELECT precio_product, descuento_product FROM producto WHERE cod_product = '$cod_product'";
                    $resProd = $conn->query($sqlProd);

                    if ($resProd && $rowProd = $resProd->fetch_assoc()) {
                        $precio = (float)$rowProd['precio_product'];
                        $descuento = (float)$rowProd['descuento_product']; // porcentaje

                        // 🔹 Calcular total de la devolución
                        $subtotal_base_devo = $precio * $cant_devo;
                        $monto_descuento_devo = $subtotal_base_devo * ($descuento / 100);
                        $subtotal_con_descuento_devo = $subtotal_base_devo - $monto_descuento_devo;
                        $iva_devo = $subtotal_con_descuento_devo * 0.15;
                        $total_devo = $subtotal_con_descuento_devo + $iva_devo;

                        // Insertar registro en devolucion con total_devo
                        $sqlDevo = "INSERT INTO devolucion (motivo_devo, cant_devo, total_devo, cod_detalle)
                                    VALUES ('$motivo', '$cant_devo', '$total_devo', '$cod_detalle')";
                        if ($conn->query($sqlDevo)) {
                            // Actualizar stock
                            $sqlStock = "UPDATE producto 
                                        SET stock_product = stock_product + $cant_devo 
                                        WHERE cod_product = '$cod_product'";
                            $conn->query($sqlStock);

                            // Calcular nueva cantidad restante
                            $cant_restante = $cant_actual - $cant_devo;

                            // 🔹 Calcular nuevo subtotal de la cantidad restante
                            $subtotal_final = 0;
                            if ($cant_restante > 0) {
                                $subtotal_base = $precio * $cant_restante;
                                $monto_descuento = $subtotal_base * ($descuento / 100);
                                $subtotal_con_descuento = $subtotal_base - $monto_descuento;
                                $iva = $subtotal_con_descuento * 0.15;
                                $subtotal_final = $subtotal_con_descuento + $iva;
                            }

                            // Actualizar cantidad y subtotal en detalle_factura_temp
                            $sqlUpdate = "UPDATE detalle_factura_temp 
                                        SET cant_detalle = $cant_restante, total_detalle = $subtotal_final 
                                        WHERE cod_detalle = '$cod_detalle'";
                            $conn->query($sqlUpdate);
                        }
                    }
                }
            }
        }
    }

    header("Location: ../views/devoluciones.php?status=success");
    exit;

} else {
    header("Location: ../views/devoluciones.php?status=error");
    exit;
}
?>
