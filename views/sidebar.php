<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Centro</div>
                <a class="nav-link" href="../views/index.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">Módulos</div>

                <a class="nav-link collapsed" href="clientes.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                    Clientes
                    <div class="sb-sidenav-collapse-arrow"></div>
                </a>

                <a class="nav-link collapsed" href="productos.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                    Productos
                    <div class="sb-sidenav-collapse-arrow"></div>
                </a>

                <a class="nav-link collapsed" href="vendedores.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-user-tie"></i></div>
                    Vendedores
                    <div class="sb-sidenav-collapse-arrow"></div>
                </a>

                <a class="nav-link collapsed" href="proveedores.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-truck"></i></div>
                    Proveedores
                    <div class="sb-sidenav-collapse-arrow"></div>
                </a>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseFacturacion" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-file-invoice"></i></div>
                    Facturación
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseFacturacion" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="facturacion.php">Nueva Factura</a>
                        <a class="nav-link" href="tablaFactura.php">Lista de Facturas</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseDevolucion" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-undo"></i></div>
                    Devoluciones
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseDevolucion" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="devoluciones.php">Devolver Factura</a>
                        <a class="nav-link" href="tablaDevoluciones.php">Lista de Devoluciones</a>
                    </nav>
                </div>
            </div>
        </div>
    </nav>
</div>