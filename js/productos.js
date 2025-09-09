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

function activaDesactivarProducto(id) {
    if (confirm("¿Estás seguro de que deseas cambiar el estado del producto?")) {
        $.ajax({
            url: '',
            method: 'POST',
            data: { toggle_producto: id },
            success: function(response) {
                const trimmed = $.trim(response);
                const parts = trimmed.split("-");

                if (parts[0] === "1") {
                    const estado = parts[1] === "ON" ? "productOn" : "productOff";
                    window.location.href = "../views/productos.php?status=" + estado;
                } else {
                    alert("Hubo un error al cambiar el estado.");
                }
            },
            error: function(xhr, status, error) {
                console.error("Error AJAX:", error);
                alert("Error al conectar con el servidor.");
            }
        });
    }

    return false;
}


document.addEventListener("DOMContentLoaded", function () {

  document.querySelectorAll(".drop-area").forEach((dropArea) => {
    const fileInput = dropArea.querySelector(".file-input");
    const previewContainer = dropArea.querySelector(".preview-container");
    const imagePreview = dropArea.querySelector(".preview-image");
    const removeBtn = dropArea.querySelector(".remove-btn");
    const initialContent = dropArea.querySelector(".initial-content"); // usa clase en vez de ID para múltiples

    let currentFile = null;
    
    // Abrir selector al hacer clic
    dropArea.addEventListener("click", () => {
      fileInput.click();
    });

    // Drag & Drop
    ["dragenter", "dragover", "dragleave", "drop"].forEach((eventName) => {
      dropArea.addEventListener(eventName, (e) => {
        e.preventDefault();
        e.stopPropagation();

        if (eventName === "dragenter" || eventName === "dragover") {
          dropArea.classList.add("active");
        } else {
          dropArea.classList.remove("active");
        }
      });
    });

    // Selección de archivo
    fileInput.addEventListener("change", function () {
      if (this.files.length) {
        handleFile(this.files[0]);
      }
    });

    // Manejo del drop
    dropArea.addEventListener("drop", function (e) {
      const files = e.dataTransfer.files;
      if (files.length) {
        handleFile(files[0]);
      }
    });

    // Vista previa
    function handleFile(file) {
      const validTypes = ["image/jpeg", "image/png", "image/jpg"];
      if (!validTypes.includes(file.type)) {
        alert("Por favor, sube solo imágenes en formato JPG, JPEG o PNG.");
        return;
      }

      const reader = new FileReader();
      reader.onload = function (e) {
        imagePreview.src = e.target.result;
        previewContainer.classList.remove("hidden");
        initialContent?.classList.add("hidden");
        dropArea.classList.add("image-loaded");
        dropArea.classList.remove("drop-area-error");
        currentFile = file;
      };
      reader.readAsDataURL(file);
    }

    // Eliminar imagen
    removeBtn?.addEventListener("click", function (e) {
      e.stopPropagation();
      resetDropArea();
    });

    function resetDropArea() {
      imagePreview.src = "#";
      previewContainer.classList.add("hidden");
      initialContent?.classList.remove("hidden");
      fileInput.value = "";
      currentFile = null;
      dropArea.classList.remove("image-loaded", "active");
    }
  });
});

// Mostrar imagen ya cargada desde base de datos al abrir el modal
document.querySelectorAll('[data-bs-toggle="modal"]').forEach(button => {
  button.addEventListener('click', () => {
    const modalId = button.getAttribute('data-bs-target');
    const modal = document.querySelector(modalId);
    const dropArea = modal.querySelector(".drop-area");
    const imagePreview = dropArea.querySelector(".preview-image");
    const previewContainer = dropArea.querySelector(".preview-container");
    const initialContent = dropArea.querySelector(".initial-content");

    const imageUrl = button.getAttribute("data-image-url"); // Asegúrate de pasar este atributo

    if (imageUrl) {
      imagePreview.src = imageUrl;
      previewContainer.classList.remove("hidden");
      initialContent?.classList.add("hidden");
      dropArea.classList.add("image-loaded");
    }
  });




/* Inputs */
  const nombre = document.getElementById("nombre");
  const stock = document.getElementById("stock");
  const precio = document.getElementById("precio");
  const descuento = document.getElementById("descuento");
  const categoria = document.getElementById("categoria");
  const proveedor = document.getElementById("proveedor");
 

  /* Error */
  const errorNombre = document.getElementById("nombreError");
  const errorStock = document.getElementById("stockError");
  const errorPrecio = document.getElementById("precioError");
  const errorDescuento = document.getElementById("descuentoError");
  const errorCategoria = document.getElementById("cateError");
  const errorProveedor = document.getElementById("proveError");



nombre.addEventListener("input", () => {
    validateEmpty(nombre.value, nombre, errorNombre, "El campo nombre no puede estar vacío", "nombre");
  });

stock.addEventListener("input", () => {
    if (stock.value === "") {
        showError(stock, errorStock, "El stock no puede estar vacío");
    } else if (stock.value <= 0) {
        showError(stock, errorStock, "El stock debe ser mayor a cero");
    } else {
        hideError(stock, errorStock, "stock");
    }  
  });


precio.addEventListener("input", () => {
    const valor = parseFloat(precio.value.replace(',', '.')); // por si acaso el usuario usa coma

    if (precio.value === "") {
        showError(precio, errorPrecio, "El precio no puede estar vacío");
    } else if (valor > 0) {
        hideError(precio, errorPrecio, "precio");
    } else {
        showError(precio, errorPrecio, "El precio debe ser mayor a cero");
    }
});


descuento.addEventListener("input", () => {
    const valor = parseFloat(descuento.value.replace(',', '.')); // por si acaso el usuario usa coma

    if (descuento.value === "") {
        showError(descuento, errorDescuento, "El descuento no puede estar vacío");
    } else if (valor >= 0) {
        hideError(descuento, errorDescuento, "descuento");       
    } else {
        showError(descuento, errorDescuento, "El descuento debe ser mayor a cero");
    }
});


categoria.addEventListener("change", () => {
    if (categoria.value === "") {
      showError(categoria, errorCategoria, "Debe seleccionar una categoria");
    } else {
      hideError(categoria, errorCategoria, "categoria");
    }
  });

proveedor.addEventListener("change", () => {
    if (proveedor.value === "") {
      showError(proveedor, errorProveedor, "Debe seleccionar un proveedor");
    } else {
      hideError(proveedor, errorProveedor, "proveedor");
    }
  });


  function validateEmpty(valueInput, divInput, divError, error, field) {
    if (valueInput.trim().length == 0) {
      showError(divInput, divError, error);
    } else {
      hideError(divInput, divError, field);
    }
  }

  function showError(divInput, divError, error) {
    divInput.style.border = "2px solid red";
    divError.classList.remove("text-success");
    divError.classList.add("text-danger");
    divError.innerText = error;
  }

  function hideError(divInput, divError, field) {
    divInput.style.border = "2px solid green";
    divError.classList.remove("text-danger");
    divError.classList.add("text-success");
    divError.innerText = `Campo ${field} válido`;
  }

  


  const form = document.getElementById("formRegistro"); // Usa el id real de tu <form>


    form.addEventListener("submit", (e) => {
    let esValido = true;

    // Validar campo nombre
    if (nombre.value.trim().length == 0) {
      showError(nombre, errorNombre, "El campo nombre no puede estar vacío");
      esValido = false;
    }

    // Validar campo stock
    if (stock.value === "") {
        showError(stock, errorStock, "El stock no puede estar vacío");
        esValido = false;

    } else if (stock.value <= 0) {
        showError(stock, errorStock, "El stock debe ser mayor a cero");
        esValido = false;
    }

    // Validar precio
    if (precio.value === "") {
        showError(precio, errorPrecio, "El precio no puede estar vacío");
        esValido = false;

    } else if (precio.value <= 0) {
        showError(precio, errorPrecio, "El precio debe ser mayor a cero");
        esValido = false;
    }


    // Validar decuento
    if (descuento.value === "") {
        showError(descuento, errorDescuento, "El descuento no puede estar vacío");
        esValido = false;
    } else if (descuento.value < 0) {
        showError(descuento, errorDescuento, "El descuento debe ser mayor a cero");
        esValido = false;
    }

    // Validar proveedor
    if (categoria.value === "") {
      showError(categoria, errorCategoria, "Debe seleccionar una categoria");
      esValido = false;
    }

    // Validar proveedor
    if (proveedor.value === "") {
      showError(proveedor, errorProveedor, "Debe seleccionar un proveedor");
      esValido = false;
    }

    const dropArea = document.querySelector(".drop-area");
    const imagePreview = dropArea.querySelector(".preview-image");
    const hasImage = imagePreview && imagePreview.src && imagePreview.src !== "#" && imagePreview.src !== "";

    if (!hasImage) {
        dropArea.classList.add("drop-area-error");
        esValido = false;
    }
    // Si hay algún error, evita que se envíe el formulario
    if (!esValido) {
      e.preventDefault();
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
