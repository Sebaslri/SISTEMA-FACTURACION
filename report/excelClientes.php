<?php
include 'vendor/autoload.php'; 
include '../controller/db.php'; // Ajusta el path según la ubicación de tu archivo de conexión

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle("Clientes");

// Encabezados
$encabezados = [
    'Cédula o RUC', 'Tipo RUC', 'Nombre', 'Apellido',
    'Teléfono', 'Correo', 'Dirección', 'Cantón', 'Estado'
];

$col = 'A';
foreach ($encabezados as $encabezado) {
    $sheet->setCellValue($col . '1', $encabezado);
    $col++;
}

// Consulta
$sql = "SELECT cliente.*, canton.descrip_canton, tipo_cliente.descrip_tipo_client
        FROM cliente
        LEFT JOIN canton ON cliente.cod_canton = canton.cod_canton
        LEFT JOIN tipo_cliente ON cliente.cod_tipo_client = tipo_cliente.cod_tipo_client";
$resultado = $conn->query($sql);

$fila = 2;
while ($row = $resultado->fetch_assoc()) {
    $sheet->setCellValue("A$fila", $row['cod_client']);
    $sheet->setCellValue("B$fila", $row['descrip_tipo_client'] ?: 'N/A');
    $sheet->setCellValue("C$fila", $row['nombre_client']);
    $sheet->setCellValue("D$fila", $row['apellido_client']);
    $sheet->setCellValue("E$fila", $row['telf_client']);
    $sheet->setCellValue("F$fila", $row['correo_client']);
    $sheet->setCellValue("G$fila", $row['direccion_client']);
    $sheet->setCellValue("H$fila", $row['descrip_canton']);
    $sheet->setCellValue("I$fila", $row['estado_client']);
    $fila++;
}

// Limpia cualquier buffer de salida
if (ob_get_length()) ob_end_clean();

// Encabezados para descarga
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Clientes.xlsx"');
header('Cache-Control: max-age=0');

// Escritura
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;

