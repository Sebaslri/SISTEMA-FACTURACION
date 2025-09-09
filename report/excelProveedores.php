<?php
include 'vendor/autoload.php'; 
include '../controller/db.php'; // Ajusta si está en otra ruta

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle("Productos");

// Encabezados
$encabezados = [
    'Logo (URL)', 'RUC', 'Tipo Contribuyente', 'Nombre', 'Teléfono', 
    'Correo', 'Direccion', 'Estado'
];

$col = 'A';
foreach ($encabezados as $encabezado) {
    $sheet->setCellValue($col . '1', $encabezado);
    $col++;
}

// Consulta
$sql = "SELECT proveedor.*, tipo_cliente.descrip_tipo_client
        FROM 
        proveedor 
        LEFT JOIN 
        tipo_cliente ON proveedor.cod_tipo_client = tipo_cliente.cod_tipo_client";
$resultado = $conn->query($sql);

$fila = 2;
while ($row = $resultado->fetch_assoc()) {
    $sheet->setCellValue("A$fila", $row['logo_prove']); // URL de la imagen
    $sheet->setCellValue("B$fila", $row['cod_prove']);
    $sheet->setCellValue("C$fila", $row['descrip_tipo_client']);
    $sheet->setCellValue("D$fila", $row['nombre_prove']);
    $sheet->setCellValue("E$fila", $row['telf_prove']);
    $sheet->setCellValue("F$fila", $row['correo_prove']);
    $sheet->setCellValue("G$fila", $row['direccion_prove']);
    $sheet->setCellValue("H$fila", $row['estado_prove']);
    $fila++;
}

// Limpia cualquier buffer de salida
if (ob_get_length()) ob_end_clean();

// Cabeceras
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Proveedores.xlsx"');
header('Cache-Control: max-age=0');

// Guardar
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;