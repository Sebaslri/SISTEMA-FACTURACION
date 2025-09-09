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

function activaDesactivarProveedor(id) {
    if (confirm("¿Estás seguro de que deseas cambiar el estado del Proveedor?")) {
        console.log(id);
        
        $.ajax({
            url: '',
            method: 'POST',
            data: { toggle_prove: id },
            success: function(response) {
                const trimmed = $.trim(response);
                const parts = trimmed.split("-");
                
                if (parts[0] === "1") {
                    const estado = parts[1] === "ON" ? "ProveOn" : "ProveOff";
                    window.location.href = "../views/proveedores.php?status=" + estado;
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



document.addEventListener("DOMContentLoaded", () => {

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






 

  const ruc = document.getElementById("RUC");
  const tipoPersonaSelect = document.getElementById("tipo-persona");

  //validacion de los campos del registro

  /* Inputs */
  const nombre = document.getElementById("nombre");
  const telefono = document.getElementById("telf");
  const email = document.getElementById("correo");
  const direccion = document.getElementById("direccion");



  /* Error */
  const errorRuc = document.getElementById("rucError");
  const errorTipoPersonaSelect = document.getElementById("tipoPersoError");
  const errorNombre = document.getElementById("nombreError");
  const errorApellido = document.getElementById("apellidoError");
  const errorTelefono = document.getElementById("telfError");
  const errorEmail = document.getElementById("correoError");
  const errorDireccion = document.getElementById("direcError");



  tipoPersonaSelect.addEventListener("change", () => {
    if (tipoPersonaSelect.value === "") {
      showError(tipoPersonaSelect, errorTipoPersonaSelect, "Escoja una tipo de contribuyente"
      );
    } else {
      hideError(tipoPersonaSelect, errorTipoPersonaSelect, "tipo contribuyente");
      ruc.value = "";
      ruc.style.border = "";
      errorRuc.innerText = "";      

    }
  });

  ruc.addEventListener("input", () => {
    if (tipoPersonaSelect.value == 1) {
      if (ruc.value.length !== 13) {
        showError(ruc, errorRuc, "El ruc tiene que ser de 13 dígitos");
      } else {
        rucNatural(ruc.value);
      }
    } else if (tipoPersonaSelect.value == 2) {
      if (ruc.value.length !== 13) {
        showError(ruc, errorRuc, "El ruc tiene que ser de 13 dígitos");
      } else {
        rucSociedadPrivada(ruc.value);
      }
    } else if (tipoPersonaSelect.value == 3) {
      if (ruc.value.length !== 13) {
        showError(ruc, errorRuc, "El ruc tiene que ser de 13 dígitos");
      } else {
        rucSociedadPublica(ruc.value);
      }
    } else {
      showError(ruc, errorRuc, "Tiene que escoger un tipo de RUC");
    }
  });


  nombre.addEventListener("input", () => {
    validateEmpty(
      nombre.value,
      nombre,
      errorNombre,
      "El campo nombre no puede estar vacío",
      "nombre"
    );
  });

  telefono.addEventListener("input", () => {
    if (telefono.value.length < 10 || telefono.value.length > 10) {
      showError(
        telefono,
        errorTelefono,
        "El campo teléfono debe tener 10 dígitos"
      );
    } else {
      hideError(telefono, errorTelefono, "telefono");
    }
  });

  email.addEventListener("input", () => {
    validateEmail(
      email.value,
      email,
      errorEmail,
      "Correo no válido ",
      "correo"
    );
  });

  direccion.addEventListener("input", () => {
    validateEmpty(
      direccion.value,
      direccion,
      errorDireccion,
      "El campo direccion no puede estar vacío",
      "direccion"
    );
  });


  function validateEmpty(valueInput, divInput, divError, error, field) {
    if (valueInput.trim().length == 0) {
      showError(divInput, divError, error);
    } else {
      hideError(divInput, divError, field);
    }
  }

  function validateEmail(valueInput, divInput, divError, error, field) {
    let regExp =
      /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/g;

    if (regExp.test(valueInput)) {
      hideError(divInput, divError, field);
    } else {
      showError(divInput, divError, error);
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


  function rucNatural(valor) {
    //.slice(0, 2) corta el string desde la posición 0 hasta antes de la posición 2.
    let provincia = parseInt(valor.slice(0, 2)); //Los primeros 2 dígitos corresponden a la provincia donde fue expedida
    let tercerDigito = parseInt(valor[2]);
    let establecimientos = valor.slice(10, 13); // numero de establecimiento (001, 002, 003)
    if (provincia > 0 && provincia < 25) {
      if (tercerDigito > 0 && tercerDigito < 6) {
        if (establecimientos != '000') {
          //El tercer dígito es un número menor a 6 (0,1,2,3,4,5).
          let coeficientes = "212121212";
          let resultante = [];
          for (let i = 0; i < 9; i++) {
            mult = parseInt(valor[i]) * parseInt(coeficientes[i]);
            resultante[i] = mult >= 10 ? mult - 9 : mult;
          }

          /* let suma = resultante.reduce((acumulador, valorActual) => acumulador + valorActual, 0); */

          let suma = 0;

          for (let i = 0; i < resultante.length; i++) {
            suma += resultante[i];
          }

          let residuo = suma % 10;
          let digitoVerificador = residuo === 0 ? 0 : 10 - residuo;

          if (digitoVerificador === parseInt(valor[9])) {
            hideError(ruc, errorRuc, "ruc");
          } else {
            showError(ruc, errorRuc, "Ruc inválido");
          }
        } else {
            showError(ruc, errorRuc, "Número de establecimiento incorrecto");
        }
      } else {
        showError(ruc, errorRuc, "Tercer dígito incorrecto");
      }
    } else {
      showError(ruc, errorRuc, "Los dos primeros dígitos son incorrectos"
      );
    }
  }

  function rucSociedadPrivada(valor) {
    //.slice(0, 2) corta el string desde la posición 0 hasta antes de la posición 2.
    let provincia = parseInt(valor.slice(0, 2)); //Los primeros 2 dígitos corresponden a la provincia donde fue expedida
    let tercerDigito = parseInt(valor[2]);
    let establecimientos = valor.slice(10, 13); // numero de establecimiento (001, 002, 003)
    if (provincia > 0 && provincia < 25) {
      if ( tercerDigito == 9) {
        if (establecimientos != '000') {
          //El tercer dígito es un número menor a 6 (0,1,2,3,4,5).
          let coeficientes = "432765432";
          let resultante = [];

          for (let i = 0; i < 9; i++) {
            resultante[i] = parseInt(valor[i]) * parseInt(coeficientes[i]);
          }

          /* let suma = resultante.reduce((acumulador, valorActual) => acumulador + valorActual, 0); */

          let suma = 0;

          for (let i = 0; i < resultante.length; i++) {
            suma += resultante[i];
          }

          let residuo = suma % 11;
          let digitoVerificador = residuo === 0 ? 0 : 11 - residuo;

          if (digitoVerificador === parseInt(valor[9])) {
            hideError(ruc, errorRuc, "ruc");
          } else {
            showError(ruc, errorRuc, "Ruc inválido");
          }
        } else {
            showError(ruc, errorRuc, "Número de establecimiento incorrecto");
        }
      } else {
        showError(ruc, errorRuc, "Tercer dígito incorrecto");
      }
    } else {
      showError(ruc, errorRuc, "Los dos primeros dígitos son incorrectos"
      );
    }
  }

  function rucSociedadPublica(valor) {
    //.slice(0, 2) corta el string desde la posición 0 hasta antes de la posición 2.
    let provincia = parseInt(valor.slice(0, 2)); //Los primeros 2 dígitos corresponden a la provincia donde fue expedida
    let tercerDigito = parseInt(valor[2]);
    let establecimientos = valor.slice(10, 13); // numero de establecimiento (001, 002, 003)
    if (provincia > 0 && provincia < 25) {
      if ( tercerDigito == 6) {
        if (establecimientos != '000') {
          //El tercer dígito es un número menor a 6 (0,1,2,3,4,5).
          let coeficientes = "32765432";
          let resultante = [];
          for (let i = 0; i < 8; i++) {
            resultante[i] = parseInt(valor[i]) * parseInt(coeficientes[i]);
          }

          /* let suma = resultante.reduce((acumulador, valorActual) => acumulador + valorActual, 0); */

          let suma = 0;

          for (let i = 0; i < resultante.length; i++) {
            suma += resultante[i];
          }

          let residuo = suma % 11;
          
          
          let digitoVerificador = residuo === 0 ? 0 : 11 - residuo;

          if (digitoVerificador === parseInt(valor[8])) {
            hideError(ruc, errorRuc, "ruc");
          } else {
            showError(ruc, errorRuc, "Ruc inválido");
          }
        } else {
            showError(ruc, errorRuc, "Número de establecimiento incorrecto");
        }
      } else {
        showError(ruc, errorRuc, "Tercer dígito incorrecto");
      }
    } else {
      showError(ruc, errorRuc, "Los dos primeros dígitos son incorrectos"
      );
    }
  }


  const form = document.getElementById("formRegistro"); // Usa el id real de tu <form>

  // Evento submit del formulario
  form.addEventListener("submit", (e) => {
    let esValido = true;


    if (ruc.value.length !== 13) {
      showError(ruc, errorRuc, "El ruc tiene que ser de 13 dígitos");
      esValido = false;
    }


    if (tipoPersonaSelect.value == "") {
        showError(tipoPersonaSelect, errorTipoPersonaSelect, "Escoja una tipo de contribuyente");
        esValido = false;
    }

    // Validar campo nombre
    if (nombre.value.trim().length == 0) {
      showError(nombre, errorNombre, "El campo nombre no puede estar vacío");
      esValido = false;
    }


    // Validar teléfono
    if (telefono.value.length !== 10) {
      showError(telefono, errorTelefono, "El campo teléfono debe tener 10 dígitos");
      esValido = false;
    }

    // Validar correo
    let regExp =
      /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/g;
    if (!regExp.test(email.value)) {
      showError(email, errorEmail, "Correo no válido");
      esValido = false;
    }

    // Validar dirección
    if (direccion.value.trim() === "") {
      showError(direccion, errorDireccion, "El campo dirección no puede estar vacío");
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
    } else {
        tipoPersonaSelect.disabled = false; //le quito el disabled al campo select antes de enviar el formulario porque si no el campo no se envia ni como nulo ni como vacio. Esto soluciona el error de envio en la consulta
    }

  });

  // Selecciona todos los modales con id que empiece con "exampleModal"
    const modales = document.querySelectorAll('.modal');

    modales.forEach(function (modal) {
        modal.addEventListener('hidden.bs.modal', function () {
            // Resetea el formulario dentro del modal cuando se cierra
            const form = modal.querySelector('form');
            if (form) {
                form.reset();
                // También se deben volver a seleccionar los valores de los selects (provincia y cantón)
                const selects = form.querySelectorAll('select');
                selects.forEach(select => {
                    // Vuelve a seleccionar la opción marcada como selected en HTML (atributo selected)
                    const selectedOption = select.querySelector('option[selected]');
                    if (selectedOption) {
                        select.value = selectedOption.value;
                    }
                });
            }
        });
    });

});
