<?php
include 'vendor/autoload.php'; 
include '../controller/db.php'; // Ajusta si está en otra ruta

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;


$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle("Productos");

// Encabezados
$encabezados = [
    'Imagen (URL)', 'Nombre', 'Stock', 'Precio', 
    'Descuento (%)', 'Proveedor', 'Estado'
];

$col = 'A';
foreach ($encabezados as $encabezado) {
    $sheet->setCellValue($col . '1', $encabezado);
    $col++;
}

// Consulta
$sql = "SELECT producto.*, proveedor.nombre_prove 
        FROM producto 
        LEFT JOIN proveedor ON producto.cod_prove = proveedor.cod_prove";
$resultado = $conn->query($sql);

$fila = 2;
while ($row = $resultado->fetch_assoc()) {
    $sheet->setCellValue("A$fila", $row['foto_product']); // URL de la imagen
    $sheet->setCellValue("B$fila", $row['nombre_product']);
    $sheet->setCellValue("C$fila", $row['stock_product']);
    $sheet->setCellValue("D$fila", $row['precio_product']);
    $sheet->setCellValue("E$fila", $row['descuento_product']);
    $sheet->setCellValue("F$fila", $row['nombre_prove']);
    $sheet->setCellValue("G$fila", $row['estado_product']);
    $fila++;
}

// Limpia cualquier buffer de salida
if (ob_get_length()) ob_end_clean();

// Cabeceras
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Productos.xlsx"');
header('Cache-Control: max-age=0');

// Guardar
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;

/* <?php
include 'vendor/autoload.php'; 
include '../controller/db.php'; // Ajusta si está en otra ruta

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle("Productos");

// Encabezados
$encabezados = [
    'Imagen', 'Nombre', 'Stock', 'Precio', 
    'Descuento (%)', 'Proveedor', 'Estado'
];

$col = 'A';
foreach ($encabezados as $encabezado) {
    $sheet->setCellValue($col . '1', $encabezado);
    $col++;
}

// Ajusta el ancho de la columna A para que quepan las imágenes
$sheet->getColumnDimension('A')->setWidth(15);

// Consulta
$sql = "SELECT producto.*, proveedor.nombre_prove 
        FROM producto 
        LEFT JOIN proveedor ON producto.cod_prove = proveedor.cod_prove";
$resultado = $conn->query($sql);

$fila = 2;
while ($row = $resultado->fetch_assoc()) {
    // Ruta o URL de la imagen
    $imgPath = $row['foto_product'];

    // Intenta descargar la imagen si es URL
    if (filter_var($imgPath, FILTER_VALIDATE_URL)) {
        $imgData = @file_get_contents($imgPath);
        if ($imgData !== false) {
            $tempImg = tempnam(sys_get_temp_dir(), 'img_');
            file_put_contents($tempImg, $imgData);
            $imgPath = $tempImg;
        } else {
            $imgPath = null; // No cargar imagen si falla
        }
    }

    // Si existe imagen válida, insertarla
    if ($imgPath && file_exists($imgPath)) {
        $drawing = new Drawing();
        $drawing->setPath($imgPath);
        $drawing->setCoordinates("A$fila");
        $drawing->setOffsetX(5);
        $drawing->setOffsetY(5);
        $drawing->setHeight(60);
        $drawing->setWorksheet($sheet);

        // Ajusta la altura de la fila para mostrar imagen
        $sheet->getRowDimension($fila)->setRowHeight(60);
    }

    // Resto de columnas
    $sheet->setCellValue("B$fila", $row['nombre_product']);
    $sheet->setCellValue("C$fila", $row['stock_product']);
    $sheet->setCellValue("D$fila", $row['precio_product']);
    $sheet->setCellValue("E$fila", $row['descuento_product']);
    $sheet->setCellValue("F$fila", $row['nombre_prove']);
    $sheet->setCellValue("G$fila", $row['estado_product']);

    $fila++;
}

// Limpia cualquier buffer de salida
if (ob_get_length()) ob_end_clean();

// Cabeceras para descarga
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Productos.xlsx"');
header('Cache-Control: max-age=0');

// Guardar
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit; */
