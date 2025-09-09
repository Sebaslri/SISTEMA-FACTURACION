<div class="col-xl-7">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-area me-1"></i>
                                Ventas últimos 7 días
                            </div>
                            <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                            <?php
                            // Consulta la fecha más reciente de cada tabla
                            $result = $conn->query('SELECT MAX(ultima_fecha) AS ultima_fecha
                                FROM (
                                    SELECT MAX(fecha_detalle) AS ultima_fecha FROM detalle_factura_temp
                                    UNION
                                    SELECT MAX(fecha_devo) AS ultima_fecha FROM devolucion
                                ) AS fechas');
                            $row = $result->fetch_assoc();
                            $ultima_fecha = $row['ultima_fecha']; // Devuelve la más reciente entre ambas tablas
                            ?>
                            <div class="card-footer small text-muted">
                                Updated <?php echo date("F d, Y \\a\\t h:i A", strtotime($ultima_fecha)); ?>
                            </div>
                        </div>
                    </div>

                    <?php
include '../../controller/db.php'; // tu conexión

// Rango: últimos 7 días hasta hoy
$hoy = date('Y-m-d');
$inicio = date('Y-m-d', strtotime($hoy . ' -6 days'));

// Consulta ventas por día
$sql = "
    SELECT 
        DATE(d.fecha_detalle) AS dia,
        SUM(d.total_detalle) AS total_ventas
    FROM detalle_factura_temp d
    JOIN producto p ON d.cod_product = p.cod_product
    WHERE DATE(d.fecha_detalle) BETWEEN '$inicio' AND '$hoy'
    GROUP BY DATE(d.fecha_detalle)
    ORDER BY dia ASC
";
$result = $conn->query($sql);

// Guardamos los datos en array asociativo
$datos = [];
while ($row = $result->fetch_assoc()) {
    $datos[$row['dia']] = $row;
}

// Construir arrays de los últimos 7 días
$periodo = new DatePeriod(
    new DateTime($inicio),
    new DateInterval('P1D'),
    (new DateTime($hoy))->modify('+1 day')
);

// Días en español
$dias_es = ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"];

$labels = [];
$ventas = [];

foreach ($periodo as $fecha) {
    $dia_formato = $fecha->format("Y-m-d");
    $dia_semana = $dias_es[(int)$fecha->format("w")]; 
    $dia_label = $dia_semana . " " . $fecha->format("d");

    if (isset($datos[$dia_formato])) {
        $labels[] = $dia_label;
        $ventas[] = (float)$datos[$dia_formato]['total_ventas'];
    } else {
        $labels[] = $dia_label;
        $ventas[] = 0;
    }
}

echo json_encode([
    "labels" => $labels,
    "ventas" => $ventas
], JSON_UNESCAPED_UNICODE);

$conn->close();
?>
