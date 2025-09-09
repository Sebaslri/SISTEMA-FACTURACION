/*!
 * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
 * Copyright 2013-2023 Start Bootstrap
 * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
 */
//
// Scripts
//

window.addEventListener("DOMContentLoaded", (event) => {
  // Toggle the side navigation
  const sidebarToggle = document.body.querySelector("#sidebarToggle");
  if (sidebarToggle) {
    // Uncomment Below to persist sidebar toggle between refreshes
    // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
    //     document.body.classList.toggle('sb-sidenav-toggled');
    // }
    sidebarToggle.addEventListener("click", (event) => {
      event.preventDefault();
      document.body.classList.toggle("sb-sidenav-toggled");
      localStorage.setItem(
        "sb|sidebar-toggle",
        document.body.classList.contains("sb-sidenav-toggled")
      );
    });
  }
});
document.addEventListener("DOMContentLoaded", () => {
  const buscarFactura = document.getElementById("buscarFactura");
  const resultadosFacturas = document.getElementById("resultadosFacturas");
  const productosFactura = document.getElementById("productosFactura");

  let motivoActual = null; // fila actual que edito

  // Buscar factura
  buscarFactura.addEventListener("input", function () {
    const query = this.value.trim();
    if (query.length === 0) {
      resultadosFacturas.classList.add("d-none");
      resultadosFacturas.innerHTML = "";
      return;
    }

    fetch("../controller/buscarFactura.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: "factura=" + encodeURIComponent(query),
    })
      .then((res) => res.text())
      .then((data) => {
        resultadosFacturas.innerHTML = data;
        resultadosFacturas.classList.remove("d-none");
      });
  });

// Seleccionar factura
resultadosFacturas.addEventListener("click", function (e) {
    const item = e.target.closest(".factura-item");
    if (!item) return;

    const datos = JSON.parse(item.dataset.cliente);
    const factura = item.dataset.factura;

    document.getElementById("cedulaCliente").textContent = datos.cod_client;
    document.getElementById("nombreCliente").textContent = datos.nombre_client;
    document.getElementById("apellidoCliente").textContent = datos.apellido_client;
    document.getElementById("correoCliente").textContent = datos.correo_client;
    document.getElementById("telefonoCliente").textContent = datos.telf_client;

    // Cargar productos de la factura
    fetch("../controller/obtenerProductos.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "cod_fact=" + encodeURIComponent(factura),
    })
        .then((res) => res.json())
        .then((productos) => {
            if (productos.length === 0) {
                productosFactura.innerHTML =
                    "<div class='alert alert-info'>No hay productos en esta factura.</div>";
                return;
            }

            // Filtrar productos con cantidad > 0
            const productosFiltrados = productos.filter(p => parseInt(p.cant_detalle) > 0);

            if (productosFiltrados.length === 0) {
                productosFactura.innerHTML =
                    "<div class='alert alert-info'>Todos los productos ya fueron devueltos.</div>";
                return;
            }

let tabla = `
  <table class="table table-bordered align-middle text-center rounded">
    <thead class="table-secondary">
      <tr>
        <th style="width: 100px;">Código</th>
        <th>Producto</th>
        <th style="width: 140px;">Cant. Facturada</th>
        <th style="width: 140px;">Cant. a Devolver</th>
        <th style="width: 80px;">Motivo</th>
      </tr>
    </thead>
    <tbody>
`;

productosFiltrados.forEach((p) => {
  tabla += `
    <tr>
      <td>${p.cod_product}</td>
      <td>${p.nombre_product}</td>
      <td>${p.cant_detalle}</td>
      <td>
        <input type="number" 
               name="cantidadDevuelta[${p.cod_detalle}]" 
               min="0" 
               max="${p.cant_detalle}" 
               class="form-control form-control-sm text-center" 
               placeholder="0">
      </td>
      <td>
        <input type="hidden" name="motivoDevolucion[${p.cod_detalle}]" value="">
        <a href="#" 
           class="btn btn-warning btn-sm btn-motivo" 
           data-cod="${p.cod_detalle}" 
           data-bs-toggle="modal" 
           data-bs-target="#motivoModal">
            <i class="fa-solid fa-pen" style="font-size: 1.2em;"></i>
        </a>
      </td>
    </tr>
  `;
});

            tabla += "</tbody></table>";
            productosFactura.innerHTML = tabla;
        });

    resultadosFacturas.innerHTML = "";
    resultadosFacturas.classList.add("d-none");
    buscarFactura.value = "";
});

let codActual = null;

// Cuando se abre el modal, cargar el motivo actual
document.addEventListener("click", function (e) {
    const btn = e.target.closest(".btn-motivo");
    if (btn) {
        codActual = btn.dataset.cod;
        const inputMotivo = document.querySelector(`input[name="motivoDevolucion[${codActual}]"]`);
        document.getElementById("motivoTextArea").value = inputMotivo.value;
    }
});

// Guardar motivo desde el modal en el input hidden correspondiente
document.getElementById("guardarMotivo").addEventListener("click", function () {
    if (codActual) {
        const motivo = document.getElementById("motivoTextArea").value;
        document.querySelector(`input[name="motivoDevolucion[${codActual}]"]`).value = motivo;
    }
    const modal = bootstrap.Modal.getInstance(document.getElementById("motivoModal"));
    modal.hide();
});

// Limpiar el texto del modal (opcional)
document.getElementById("limpiarMotivo").addEventListener("click", function () {
    document.getElementById("motivoTextArea").value = "";
});

    // Validar que haya al menos un producto a devolver
    document.getElementById("formDevolucion").addEventListener("submit", function (e) {
        const inputs = document.querySelectorAll('input[name^="cantidadDevuelta"]');
        let hayDev = false;
        inputs.forEach((input) => {
            if (parseInt(input.value) > 0) hayDev = true;
        });
        if (!hayDev) {
            e.preventDefault();
            alert("Debe devolver al menos un producto (cantidad > 0)");
        }
    });

    // Inicializa las alertas de Bootstrap
    $(".alert").each(function () {
      var alert = new bootstrap.Alert(this);
    });

    // Hace que la alerta desaparezca después de 3 segundos
    setTimeout(function () {
      $(".alert").alert("close");
    }, 3000);
  });

