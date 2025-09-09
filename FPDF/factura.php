<?php
require('./fpdf.php');
include '../controller/db.php';

$id_factura = $_GET['id'];

// Consultar datos de la factura
$sql_factura = "
    SELECT 
    f.*,
    c.cod_client,
    c.nombre_client,
    c.apellido_client,
    c.direccion_client,
    c.telf_client,
    v.nombre_vend
FROM factura f
JOIN cliente c ON f.cod_client = c.cod_client
JOIN vendedor v ON f.cod_vend = v.cod_vend
WHERE f.cod_fact = '$id_factura';

";
$factura = $conn->query($sql_factura)->fetch_assoc();

// Consultar detalle de la factura
$sql_detalle = "
    SELECT 
        p.cod_product AS CODIGO,
        p.nombre_product AS PRODUCTO,
        d.cant_detalle AS CANTIDAD,
        p.precio_product AS PRECIO_UNITARIO,
        p.descuento_product AS DESCUENTO
        FROM detalle_factura d
    JOIN producto p ON d.cod_product = p.cod_product
    WHERE d.cod_fact = '$id_factura'
";
$detalle = $conn->query($sql_detalle)->fetch_all(MYSQLI_ASSOC);

class PDF extends FPDF
{
    private $factura;
    private $detalle;

    function __construct($factura, $detalle)
    {
        parent::__construct();
        $this->factura = $factura;
        $this->detalle = $detalle;
    }

    // Bordes redondeados
    function RoundedRect($x, $y, $w, $h, $r, $style = '')
    {
        $k = $this->k;
        $hp = $this->h;
        if ($style == 'F') $op = 'f';
        elseif ($style == 'FD' || $style == 'DF') $op = 'B';
        else $op = 'S';
        $MyArc = 4 / 3 * (sqrt(2) - 1);
        $this->_out(sprintf('%.2F %.2F m', ($x + $r) * $k, ($hp - $y) * $k));
        $xc = $x + $w - $r;
        $yc = $y + $r;
        $this->_out(sprintf('%.2F %.2F l', $xc * $k, ($hp - $y) * $k));
        $this->_Arc($xc + $r * $MyArc, $yc - $r, $xc + $r, $yc - $r * $MyArc, $xc + $r, $yc);
        $xc = $x + $w - $r;
        $yc = $y + $h - $r;
        $this->_out(sprintf('%.2F %.2F l', ($x + $w) * $k, ($hp - $yc) * $k));
        $this->_Arc($xc + $r, $yc + $r * $MyArc, $xc + $r * $MyArc, $yc + $r, $xc, $yc + $r);
        $xc = $x + $r;
        $yc = $y + $h - $r;
        $this->_out(sprintf('%.2F %.2F l', $xc * $k, ($hp - ($y + $h)) * $k));
        $this->_Arc($xc - $r * $MyArc, $yc + $r, $xc - $r, $yc + $r * $MyArc, $xc - $r, $yc);
        $xc = $x + $r;
        $yc = $y + $r;
        $this->_out(sprintf('%.2F %.2F l', $x * $k, ($hp - $yc) * $k));
        $this->_Arc($xc - $r, $yc - $r * $MyArc, $xc - $r * $MyArc, $yc - $r, $xc, $yc - $r);
        $this->_out($op);
    }

    function _Arc($x1, $y1, $x2, $y2, $x3, $y3)
    {
        $h = $this->h;
        $this->_out(sprintf(
            '%.2F %.2F %.2F %.2F %.2F %.2F c',
            $x1 * $this->k,
            ($h - $y1) * $this->k,
            $x2 * $this->k,
            ($h - $y2) * $this->k,
            $x3 * $this->k,
            ($h - $y3) * $this->k
        ));
    }

    function Header()
    {
        // Logo
        $this->Image('../assets/img/logo.jpg', -3, -10, 60, 70);

        // Datos empresa
        $this->SetFont('Arial', 'B', 18);
        $this->Cell(0, 6, 'DeepCleaning SA', 0, 1, 'C');
        $this->SetFont('Arial', '', 10);
        $this->Ln(2);
        $this->Cell(0, 5, 'Av. Guaranda, Babahoyo', 0, 1, 'C');
        $this->Cell(0, 5, 'Ruc: 0913475331001', 0, 1, 'C');
        $this->Cell(0, 5, 'Telefono: 0956748921', 0, 1, 'C');
        $this->Cell(0, 5, 'Email: dcleaning@hotmail.com', 0, 1, 'C');
        $this->Ln(2);

        // Cuadro datos factura
        $this->RoundedRect(150, 10, 50, 35, 3, 'D');
        $this->SetFont('Arial', '', 10);

        $this->SetXY(153, 12);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(22, 5, 'No. Factura:', 0, 0);
        $this->SetFont('Arial', '', 10);
        $this->Cell(26, 5, $this->factura['cod_fact'], 0, 1);

        $this->SetXY(153, 17);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(22, 5, 'Fecha:', 0, 0);
        $this->SetFont('Arial', '', 10);
        $this->Cell(26, 5, date('d/m/Y', strtotime($this->factura['fecha_fact'])), 0, 1);

        $this->SetXY(153, 22);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(22, 5, 'Hora:', 0, 0);
        $this->SetFont('Arial', '', 10);
        $this->Cell(26, 5, date('H:i:s', strtotime($this->factura['fecha_fact'])), 0, 1);

        $this->SetXY(153, 27);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(22, 5, 'Vendedor:', 0, 0);
        $this->SetFont('Arial', '', 10);
        $this->Cell(26, 5, $this->factura['nombre_vend'], 0, 1);

        $this->Ln(15);

        // Cuadro cliente
        $this->Ln(10);
        $this->SetFillColor(230, 230, 230);
        $this->Cell(0, 8, 'Datos del Cliente', 1, 1, 'C', true);
        $this->Ln(5);
        $this->SetFont('Arial', '', 10);
        $this->Cell(100, 8, 'Cedula: ' . $this->factura['cod_client'], 0);
        $this->Cell(0, 8, 'Telefono: ' . $this->factura['telf_client'], 0, 1);
        $this->Cell(100, 8, 'Nombre: ' . $this->factura['nombre_client'] . ' ' . $this->factura['apellido_client'], 0);
        $this->Cell(0, 8, 'Direccion: ' . $this->factura['direccion_client'], 0, 1);
        $this->Ln(15);

        // Encabezado productos
        $this->SetFillColor(0, 92, 185);
        $this->SetTextColor(255);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(25, 8, 'Codigo', 1, 0, 'C', true);
        $this->Cell(65, 8, 'Descripcion', 1, 0, 'C', true);
        $this->Cell(15, 8, 'Cant.', 1, 0, 'C', true);
        $this->Cell(25, 8, 'P. Unit.', 1, 0, 'C', true);
        $this->Cell(25, 8, 'Desc.', 1, 0, 'C', true);
        $this->Cell(35, 8, 'Subtotal', 1, 1, 'C', true);
        $this->SetTextColor(0);
    }

    function Body()
    {
        $totalSinIVA = 0;
        $this->SetFont('Arial', '', 10);
        foreach ($this->detalle as $row) {
            $this->Cell(25, 8, $row['CODIGO'], 1);
            $this->Cell(65, 8, utf8_decode(substr($row['PRODUCTO'], 0, 30)), 1); // corta texto largo
            $this->Cell(15, 8, $row['CANTIDAD'], 1, 0, 'C');
            $this->Cell(25, 8, number_format($row['PRECIO_UNITARIO'], 2), 1, 0, 'R');
            $this->Cell(25, 8, $row['DESCUENTO'].'%', 1, 0, 'R');
            $this->Cell(35, 8, number_format(($row['PRECIO_UNITARIO'] * $row['CANTIDAD']) - ($row['DESCUENTO']/100) * $row['PRECIO_UNITARIO'] * $row['CANTIDAD'], 2), 1, 1, 'R');
            $totalSinIVA +=  number_format($row['PRECIO_UNITARIO'] * $row['CANTIDAD'] - ($row['DESCUENTO']/100) * $row['PRECIO_UNITARIO']* $row['CANTIDAD'], 2);
        }



        // Calcular totales;
        $iva = $totalSinIVA * 0.15;
        $totalConIVA = $totalSinIVA + $iva;

        // Espacio antes del resumen
        $this->Ln(5);

        // Posicionar resumen a la derecha
        $this->SetX(110); // mover a la derecha
        $this->SetFont('Arial', '', 10);
        $this->Cell(50, 8, 'Cantidad Total:', 1, 0, 'R');
        $this->Cell(40, 8, number_format($totalSinIVA, 2), 1, 1, 'R');

        $this->SetX(110);
        $this->Cell(50, 8, 'IVA (15%):', 1, 0, 'R');
        $this->Cell(40, 8, number_format($iva, 2), 1, 1, 'R');

        $this->SetX(110);
        $this->Cell(50, 8, 'Total + IVA:', 1, 0, 'R');
        $this->Cell(40, 8, number_format($totalConIVA, 2), 1, 1, 'R');

        $this->SetX(110);
        $this->Cell(50, 8, 'Recibido', 1, 0, 'R');
        $this->Cell(40, 8, number_format($this->factura['recibido_fact'], 2), 1, 1, 'R');

        $this->SetX(110);
        $this->Cell(50, 8, 'Vuelto', 1, 0, 'R');
        $this->Cell(40, 8, number_format($this->factura['vuelto_fact'], 2), 1, 1, 'R');
    }
}

// Generar PDF
$pdf = new PDF($factura, $detalle);
$pdf->AddPage();
$pdf->Body();
$pdf->Output('Factura.pdf', 'I');
