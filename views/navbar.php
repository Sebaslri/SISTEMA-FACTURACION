<?php
include '../controller/db.php';

$sql = $conn->query('SELECT * FROM provincia');

if (!empty($_POST['provincia'])) {
    $provincia_seleccionada = $_POST['provincia'];
    $consulta_cantones = $conn->query("SELECT * FROM canton WHERE cod_prov = '$provincia_seleccionada'");
    $cantones = [];
    while ($canton = $consulta_cantones->fetch_object()) {
        $cantones[] = $canton;
    }
    echo json_encode($cantones);
    exit;
}

include '../controller/desactivarCliente.php';
include '../controller/desactivarProducto.php';
include '../controller/desactivarVendedor.php';
include '../controller/desactivarProveedor.php';


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>DeepCleaning SA</title>
    <link rel="icon" href="../assets/img/logo-pagina.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <link href="../css/style.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>



</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <img src="../assets/img/logo.jpg" width="45" height="45" class="rounded-circle ms-3" alt="Logo">
        <a class="navbar-brand ps-3 me-2" style="width: auto;" href="../views/index.php">Deep Cleaning SA</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 ms-n2 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    </nav>