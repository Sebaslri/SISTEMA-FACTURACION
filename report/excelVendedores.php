<?php
include 'vendor/autoload.php'; 
include '../controller/db.php'; // Ajusta el path según la ubicación de tu archivo de conexión

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle("vendes");

// Encabezados
$encabezados = [
    'Cédula', 'Nombre', 'Apellido',
    'Teléfono', 'Correo', 'Dirección', 'Cantón', 'Estado'
];

$col = 'A';
foreach ($encabezados as $encabezado) {
    $sheet->setCellValue($col . '1', $encabezado);
    $col++;
}

// Consulta
$sql = "SELECT vendedor.*, canton.* FROM vendedor 
        LEFT JOIN 
        canton ON vendedor.cod_canton = canton.cod_canton ";
$resultado = $conn->query($sql);

$fila = 2;
while ($row = $resultado->fetch_assoc()) {
    $sheet->setCellValue("A$fila", $row['cod_vend']);
    $sheet->setCellValue("B$fila", $row['nombre_vend']);
    $sheet->setCellValue("C$fila", $row['apellido_vend']);
    $sheet->setCellValue("D$fila", $row['telf_vend']);
    $sheet->setCellValue("E$fila", $row['correo_vend']);
    $sheet->setCellValue("F$fila", $row['direccion_vend']);
    $sheet->setCellValue("G$fila", $row['descrip_canton']);
    $sheet->setCellValue("H$fila", $row['estado_vend']);
    $fila++;
}

// Limpia cualquier buffer de salida
if (ob_get_length()) ob_end_clean();

// Encabezados para descarga
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="vendedores.xlsx"');
header('Cache-Control: max-age=0');

// Escritura
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;

