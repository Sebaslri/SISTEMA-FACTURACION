<?php
include 'vendor/autoload.php'; 
include '../controller/db.php'; // Ajusta el path según la ubicación de tu archivo de conexión

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle("Clientes");

// Encabezados
$encabezados = ['Codigo', 'Factura N°', 'Fecha', 'Producto', 'Cantidad devuelta', 'Total'];

$col = 'A';
foreach ($encabezados as $encabezado) {
    $sheet->setCellValue($col . '1', $encabezado);
    $col++;
}

// Consulta
$sql = "SELECT detalle_factura_temp.*, producto.nombre_product
        FROM detalle_factura_temp 
        LEFT JOIN 
        producto ON detalle_factura_temp.cod_product = producto.cod_product";
$resultado = $conn->query($sql);

$fila = 2;
while ($row = $resultado->fetch_assoc()) {
    $sheet->setCellValue("A$fila", $row['cod_detalle']);
    $sheet->setCellValue("B$fila", $row['cod_fact']);
    $sheet->setCellValue("C$fila", $row['fecha_detalle']);
    $sheet->setCellValue("D$fila", $row['nombre_product']);
    $sheet->setCellValue("E$fila", $row['cant_detalle']);
    $sheet->setCellValue("F$fila", $row['total_detalle']);
    $fila++;
}

// Limpia cualquier buffer de salida
if (ob_get_length()) ob_end_clean();

// Encabezados para descarga
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Devoluciones.xlsx"');
header('Cache-Control: max-age=0');

// Escritura
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;

