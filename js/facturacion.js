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

document.addEventListener("DOMContentLoaded", function () {
  // Buscar Cliente en tiempo real
  const buscarCliente = document.getElementById("buscarCliente");
  const resultadosClientes = document.getElementById("resultadosClientes");

  buscarCliente.addEventListener("input", function () {
    const query = this.value.trim();

    if (query.length === 0) {
      resultadosClientes.classList.add("d-none");
      resultadosClientes.innerHTML = "";
      return;
    }

    fetch("../controller/buscarCliente.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: "cedula=" + encodeURIComponent(query),
    })
      .then((res) => res.text())
      .then((data) => {
        resultadosClientes.innerHTML = data;
        resultadosClientes.classList.remove("d-none");
      });
  });

  // Seleccionar Cliente
  resultadosClientes.addEventListener("click", function (e) {
    const item = e.target.closest(".cliente-item");
    if (!item) return;

    const datos = JSON.parse(item.dataset.cliente);
    document.getElementById("cedulaCliente").value = datos.cod_client;
    document.getElementById("nombreCliente").value = datos.nombre_client;
    document.getElementById("apellidoCliente").value = datos.apellido_client;
    document.getElementById("correoCliente").value = datos.correo_client;
    document.getElementById("telefonoCliente").value = datos.telf_client;

    resultadosClientes.innerHTML = "";
    resultadosClientes.classList.add("d-none");
    buscarCliente.value = "";
  });

  // Cerrar resultados si se hace clic fuera
  document.addEventListener("click", function (e) {
    if (
      !buscarCliente.contains(e.target) &&
      !resultadosClientes.contains(e.target)
    ) {
      resultadosClientes.classList.add("d-none");
    }
  });

  // Buscar Vendedor en tiempo real
  const buscarVendedor = document.getElementById("buscarVendedor");
  const resultadosVendedores = document.getElementById("resultadosVendedores");

  buscarVendedor.addEventListener("input", function () {
    const query = this.value.trim();

    if (query.length === 0) {
      resultadosVendedores.classList.add("d-none");
      resultadosVendedores.innerHTML = "";
      return;
    }

    fetch("../controller/buscarVendedor.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: "cedula=" + encodeURIComponent(query),
    })
      .then((res) => res.text())
      .then((data) => {
        resultadosVendedores.innerHTML = data;
        resultadosVendedores.classList.remove("d-none");
      });
  });

  // Seleccionar Vendedor
  resultadosVendedores.addEventListener("click", function (e) {
    const item = e.target.closest(".vendedor-item");
    if (!item) return;

    const datos = JSON.parse(item.dataset.vendedor);
    document.getElementById("cedulaVendedor").value = datos.cod_vend;
    document.getElementById("nombreVendedor").value = datos.nombre_vend;
    document.getElementById("telefonoVendedor").value = datos.telf_vend;

    resultadosVendedores.innerHTML = "";
    resultadosVendedores.classList.add("d-none");
    buscarVendedor.value = "";
  });

  // Cerrar resultados si se hace clic fuera
  document.addEventListener("click", function (e) {
    if (
      !buscarVendedor.contains(e.target) &&
      !resultadosVendedores.contains(e.target)
    ) {
      resultadosVendedores.classList.add("d-none");
    }
  });

  const buscarProducto = document.getElementById("buscarProducto");
  const resultadosProductos = document.getElementById("resultadosProductos");
  const listaProductosAgregados = document.getElementById("listaProductosAgregados");
  const totalVenta = document.getElementById("totalVenta");
  const totalRecibido = document.getElementById("totalRecibido");
  const vuelto = document.getElementById("vuelto");

  // Función para actualizar totales y vuelto
function actualizarTotales() {
    let total = 0;
    listaProductosAgregados.querySelectorAll("tr").forEach((fila) => {
        const subtotalText = fila
            .querySelector(".subtotal")
            .textContent.replace("$", "");
        const subtotalNum = parseFloat(subtotalText) || 0;
        total += subtotalNum;
    });

    // Calcular IVA y total con IVA
    const iva = total * 0.15;
    const totalConIVA = total + iva;

    // Asignar total con IVA al input de totalVenta
    totalVenta.value = totalConIVA.toFixed(2);

    // Igualar totalRecibido al total con IVA si no ha sido editado manualmente
    if (!totalRecibido.dataset.editado) {
        totalRecibido.value = totalConIVA.toFixed(2);
    }

    const recibido = parseFloat(totalRecibido.value) || 0;
    const change = recibido - totalConIVA;
    vuelto.value = (change >= 0 ? change : 0).toFixed(2);

    // Mostrar en el resumen
    document.getElementById("resumenSubtotal").textContent = `$${total.toFixed(2)}`;
    document.getElementById("resumenIVA").textContent = `$${iva.toFixed(2)}`;
    document.getElementById("resumenTotal").textContent = `$${totalConIVA.toFixed(2)}`;
}


  // Búsqueda en tiempo real
  buscarProducto.addEventListener("input", function () {
    const query = this.value.trim();

    if (query.length === 0) {
      resultadosProductos.classList.add("d-none");
      resultadosProductos.innerHTML = "";
      return;
    }

    fetch("../controller/buscarProducto.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: "query=" + encodeURIComponent(query),
    })
      .then((res) => res.text())
      .then((data) => {
        resultadosProductos.innerHTML = data;
        resultadosProductos.classList.remove("d-none");
      });
  });

  // Agregar producto a la tabla
  resultadosProductos.addEventListener("click", function (e) {
    const target = e.target.closest(".producto-item");
    if (!target) return;

    const producto = JSON.parse(target.dataset.producto);

    // Evitar duplicados
    if (document.querySelector(`tr[data-id="${producto.cod_product}"]`)) {
      alert("Este producto ya está agregado.");
      return;
    }

    const precio = parseFloat(producto.precio_product);
    const descuento = parseFloat(producto.descuento_product);
    const stock = producto.stock_product || 0;

    const subtotal = (precio * (1 - descuento / 100)).toFixed(2);

    const filaHTML = `
        <tr data-id="${producto.cod_product}">
            <td>${producto.nombre_product}</td>
            <td>${stock}</td>
            <td>$${precio.toFixed(2)}</td>
            <td><input type="number" min="1" max="${stock}" value="1" class="form-control cantidad-input" style="width:80px; margin:auto;"></td>
            <td>${descuento}</td>
            <td class="subtotal">$${subtotal}</td>
            <td><button type="button" class="btn btn-sm btn-danger btn-eliminar">Eliminar</button></td>
        </tr>
    `;

    listaProductosAgregados.insertAdjacentHTML("beforeend", filaHTML);
    actualizarTotales();

    // Reset búsqueda
    buscarProducto.value = "";
    resultadosProductos.innerHTML = "";
    resultadosProductos.classList.add("d-none");
  });

  // Actualizar subtotal cuando cambie cantidad
  listaProductosAgregados.addEventListener("input", function (e) {
    if (!e.target.classList.contains("cantidad-input")) return;

    const input = e.target;
    let cantidad = parseInt(input.value);
    const fila = input.closest("tr");
    const stock = parseInt(fila.cells[1].textContent);

    if (isNaN(cantidad) || cantidad < 1) {
      cantidad = 1;
      input.value = cantidad;
    } else if (cantidad > stock) {
      cantidad = stock;
      input.value = cantidad;
      alert("Cantidad no puede ser mayor al stock disponible.");
    }

    const precio = parseFloat(fila.cells[2].textContent.replace("$", ""));
    const descuento = parseFloat(fila.cells[4].textContent);

    const nuevoSubtotal = (precio * cantidad * (1 - descuento / 100)).toFixed(
      2
    );
    fila.querySelector(".subtotal").textContent = `$${nuevoSubtotal}`;

    actualizarTotales();
  });

  // Eliminar producto
  listaProductosAgregados.addEventListener("click", function (e) {
    if (!e.target.classList.contains("btn-eliminar")) return;

    if (confirm("¿Seguro que deseas eliminar este producto?")) {
      e.target.closest("tr").remove();
      actualizarTotales();
    }
  });

  // Marcar si el usuario edita manualmente el total recibido
  totalRecibido.addEventListener("input", function () {
    this.dataset.editado = true;
    actualizarTotales();
  });

  // Cerrar resultados al hacer clic afuera
  document.addEventListener("click", function (e) {
    if (
      !buscarProducto.contains(e.target) &&
      !resultadosProductos.contains(e.target)
    ) {
      resultadosProductos.classList.add("d-none");
    }
  });

  document.getElementById("formFactura").addEventListener("submit", function (e) {
    const productos = [];

    listaProductosAgregados.querySelectorAll("tr").forEach(fila => {
        const id = fila.dataset.id;
        const cantidad = fila.querySelector(".cantidad-input").value;
        const subtotal = parseFloat(fila.querySelector(".subtotal").textContent.replace("$", ""));

        productos.push({ id, cantidad, subtotal });
    });

    if (productos.length === 0) {
        e.preventDefault();
        alert("Debe agregar al menos un producto.");
        return;
    }

    // Eliminar input oculto previo si existe
    let inputHidden = document.querySelector("input[name='productos']");
    if (inputHidden) inputHidden.remove();

    // Crear input oculto
    inputHidden = document.createElement("input");
    inputHidden.type = "hidden";
    inputHidden.name = "productos";
    inputHidden.value = JSON.stringify(productos);
    this.appendChild(inputHidden);
    
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
