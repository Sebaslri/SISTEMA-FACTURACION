<?php
include 'vendor/autoload.php'; 
include '../controller/db.php'; // Ajusta el path según la ubicación de tu archivo de conexión

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle("Clientes");

// Encabezados
$encabezados = ['Codigo', 'Fecha', 'Cliente', 'Vendedor', 'Total Factura', 'Recibido', 'Vuelto'];

$col = 'A';
foreach ($encabezados as $encabezado) {
    $sheet->setCellValue($col . '1', $encabezado);
    $col++;
}

// Consulta
$sql = "SELECT factura.*, cliente.nombre_client, vendedor.nombre_vend
        FROM factura
        LEFT JOIN cliente ON cliente.cod_client = factura.cod_client
        LEFT JOIN vendedor ON vendedor.cod_vend = factura.cod_vend";
$resultado = $conn->query($sql);

$fila = 2;
while ($row = $resultado->fetch_assoc()) {
    $sheet->setCellValue("A$fila", $row['cod_fact']);
    $sheet->setCellValue("B$fila", $row['fecha_fact']);
    $sheet->setCellValue("C$fila", $row['nombre_client']);
    $sheet->setCellValue("D$fila", $row['nombre_vend']);
    $sheet->setCellValue("E$fila", $row['total_fact']);
    $sheet->setCellValue("F$fila", $row['recibido_fact']);
    $sheet->setCellValue("G$fila", $row['vuelto_fact']);
    $fila++;
}

// Limpia cualquier buffer de salida
if (ob_get_length()) ob_end_clean();

// Encabezados para descarga
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Facturacion.xlsx"');
header('Cache-Control: max-age=0');

// Escritura
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;

