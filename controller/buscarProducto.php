<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['query'])) {
    $query = $conn->real_escape_string($_POST['query']);

    $sql = "SELECT cod_product, nombre_product, precio_product, descuento_product, stock_product, foto_product, estado_product
            FROM producto 
            WHERE nombre_product LIKE '%$query%' 
            AND estado_product = 1
            LIMIT 10";
    $res = $conn->query($sql);

    if ($res->num_rows > 0) {
        while ($prod = $res->fetch_object()) {
            // Si el stock es igual a 0, no mostrar el producto
            if ($prod->stock_product == 0) continue;

            $json = htmlspecialchars(json_encode($prod), ENT_QUOTES, 'UTF-8');

            $foto = !empty($prod->foto_product) ? $prod->foto_product : "../assets/productos/default.png";

            echo "
            <div class='producto-item d-flex align-items-center p-2 mb-1 border rounded' data-producto='{$json}'>
                <img src='{$foto}' alt='{$prod->nombre_product}' class='me-2' style='width:50px; height:50px; object-fit:cover; border-radius:4px;'>
                <div>
                    <strong>{$prod->nombre_product}</strong><br>
                    <small class='text-muted'>Precio: \${$prod->precio_product} | Stock: {$prod->stock_product}</small>
                </div>
            </div>";
        }
    } else {
        echo "<div class='alert alert-warning'>No se encontraron productos</div>";
    }
}
?>
