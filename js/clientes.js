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

function activaDesactivarCliente(id) {
    if (confirm("¿Estás seguro de que deseas cambiar el estado del Cliente?")) {
        $.ajax({
            url: '',
            method: 'POST',
            data: { toggle_cliente: id },
            success: function(response) {
                const trimmed = $.trim(response);
                const parts = trimmed.split("-");
                
                if (parts[0] === "1") {
                    const estado = parts[1] === "ON" ? "ClientOn" : "ClientOff";
                    window.location.href = "../views/clientes.php?status=" + estado;
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
  $(document).ready(function () { // select dinamico registro
    $("#provincia").change(function () {        
      var provinciaId = $(this).val();
      if (provinciaId) {
        $.ajax({
          type: "POST",
          url: "",
          data: {
            provincia: provinciaId,
          },
          success: function (response) {
            var cantones = JSON.parse(response);
            $("#canton").html(
              '<option value="">Seleccionar Cantón...</option>'
            );
            for (var i = 0; i < cantones.length; i++) {
              $("#canton").append(
                '<option value="' +cantones[i].cod_canton +'">' +cantones[i].descrip_canton +"</option>"
              );
            }            
          },
        });
      } else {
        $("#canton").html('<option value="">Seleccionar Cantón...</option>');
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


  $(document).ready(function () {//select dinamico modales
  // Escuchar el cambio de cualquier select de provincia en modales

  /* ¿Cuál es el problema?
    Tienes varios modales para editar clientes.
    Pero usas id="provinciaedit" y id="cantonedit" en todos los modales.

    Eso no está bien porque los IDs deben ser únicos.
    El navegador solo reconoce el primer elemento con ese ID, por eso solo funciona el primer modal. 
    
    ¿Por qué ahora sí funciona?
    Porque .provincia-select y .canton-select pueden repetirse y el código buscará la que está dentro del modal correcto*/

    $(".provincia-select").change(function () {
        var provinciaId = $(this).val();
        var $modal = $(this).closest(".modal");
        var $canton = $modal.find(".canton-select"); //es recomendable usar clases debido a que si usas id solo tomara el del primer cliente y no los demas

        if (provinciaId) {
        $.ajax({
            type: "POST",
            url: "",
            data: {
            provincia: provinciaId,
            },
            success: function (response) {
            var cantones = JSON.parse(response);
            $canton.html('<option value="">Seleccionar Cantón...</option>');
            for (var i = 0; i < cantones.length; i++) {
                $canton.append('<option value="' + cantones[i].cod_canton +'">' + cantones[i].descrip_canton + "</option>");
            }
            },
        });
        } else {
        $canton.html('<option value="">Seleccionar Cantón...</option>');
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



  const tipoCedula = document.getElementById("tipo-cedula");
  const tipoRuc = document.getElementById("tipo-ruc");
  const cedula = document.getElementById("cedula");
  const ruc = document.getElementById("RUC");
  const tipoPersonaSelect = document.getElementById("tipo-persona");

  //validacion de los campos del registro

  /* Inputs */
  const nombre = document.getElementById("nombre");
  const apellido = document.getElementById("apellido");
  const telefono = document.getElementById("telf");
  const email = document.getElementById("correo");
  const direccion = document.getElementById("direccion");
  const provincia = document.getElementById("provincia");
  const canton = document.getElementById("canton");


  /* Error */
  const errorCedula = document.getElementById("cedulaError");
  const errorRuc = document.getElementById("rucError");
  const errorTipoPersonaSelect = document.getElementById("tipoPersoError");
  const errorTipo = document.getElementById("tipoError");
  const errorNombre = document.getElementById("nombreError");
  const errorApellido = document.getElementById("apellidoError");
  const errorTelefono = document.getElementById("telfError");
  const errorEmail = document.getElementById("correoError");
  const errorDireccion = document.getElementById("direcError");
  const errorProvincia = document.getElementById("provError");
  const errorCanton = document.getElementById("cantonError");

  tipoCedula.addEventListener("change", () => {
    cedula.value = "";
    ruc.value = "";
    tipoPersonaSelect.value = "";
    errorTipo.innerText = "";
    errorRuc.innerText = "";
    tipoCedula.style.border = "";
    tipoRuc.style.border = "";
    cedula.disabled = false;
    errorCedula.innerText = "";
    ruc.disabled = true;
    tipoPersonaSelect.style.border = "";
    errorTipoPersonaSelect.innerText = "";
    tipoPersonaSelect.disabled = true;
    ruc.style.border = "";
  });

  tipoRuc.addEventListener("change", () => {
    cedula.value = "";
    ruc.value = "";
    tipoPersonaSelect.value = "";
    errorTipo.innerText = "";
    errorRuc.innerText = "";
    tipoRuc.style.border = "";
    tipoCedula.style.border = "";
    cedula.disabled = true;
    errorCedula.innerText = "";
    ruc.disabled = false;
    tipoPersonaSelect.disabled = false;
    cedula.style.border = "";
  });

  tipoPersonaSelect.addEventListener("change", () => {
    if (tipoPersonaSelect.value === "") {
      showError(tipoPersonaSelect, errorTipoPersonaSelect, "Escoja una tipo de Contribuyente"
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

  cedula.addEventListener("input", () => {
    if (cedula.value.length !== 10) {
      showError(cedula, errorCedula, "La cédula tiene que ser de 10 dígitos");
    } else {
      cedulaValidation(cedula.value);
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

  apellido.addEventListener("input", () => {
    validateEmpty(
      apellido.value,
      apellido,
      errorApellido,
      "El campo apellido no puede estar vacío",
      "apellido"
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

  provincia.addEventListener("change", () => {
    if (provincia.value === "") {
      showError(provincia, errorProvincia, "Debe seleccionar una provincia");
    } else {
      hideError(provincia, errorProvincia, "provincia");
    }
  });

  canton.addEventListener("change", () => {
    if (canton.value === "") {
      showError(canton, errorCanton, "Debe seleccionar un cantón");
    } else {
      hideError(canton, errorCanton, "canton");
    }
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

  // Funciónes para validar cédula
  function cedulaValidation(ced) {
    //.slice(0, 2) corta el string desde la posición 0 hasta antes de la posición 2.
    let provincia = parseInt(ced.slice(0, 2)); //Los primeros 2 dígitos corresponden a la provincia donde fue expedida
    let tercerDigito = parseInt(ced[2]);
    if (provincia > 0 && provincia < 25) {
      if (tercerDigito > 0 && tercerDigito < 6) {
        //El tercer dígito es un número menor a 6 (0,1,2,3,4,5).

        let coeficientes = "212121212";
        let resultante = [];
        for (let i = 0; i < 9; i++) {
          mult = parseInt(ced[i]) * parseInt(coeficientes[i]);
          resultante[i] = mult >= 10 ? mult - 9 : mult;
        }

        /* let suma = resultante.reduce((acumulador, valorActual) => acumulador + valorActual, 0); */

        let suma = 0;

        for (let i = 0; i < resultante.length; i++) {
          suma += resultante[i];
        }

        let residuo = suma % 10;
        let digitoVerificador = residuo === 0 ? 0 : 10 - residuo;

        if (digitoVerificador === parseInt(ced[9])) {
          hideError(cedula, errorCedula, "cédula");
        } else {
          showError(cedula, errorCedula, "Cédula inválida");
        }
      } else {
        showError(cedula, errorCedula, "Tercer dígito incorrecto");
      }
    } else {
      showError(
        cedula,
        errorCedula,
        "Los dos primeros dígitos son incorrectos"
      );
    }
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

    if (!tipoCedula.checked && !tipoRuc.checked) {
      showError(tipoCedula, errorTipo, "Debe seleccionar un tipo");
      showError(tipoRuc, errorTipo, "Debe seleccionar un tipo");
      esValido = false;
    }

    if (cedula.value.length !== 10 && cedula.getAttribute("disabled") == null) {
      showError(cedula, errorCedula, "La cédula tiene que ser de 10 dígitos");
      e.preventDefault();
      esValido = false;
    }

    if (ruc.value.length !== 13 && ruc.getAttribute("disabled") == null) {
      showError(ruc, errorRuc, "El ruc tiene que ser de 13 dígitos");
      esValido = false;
    }

    if (tipoPersonaSelect.getAttribute("disabled") == null) {
      if (tipoPersonaSelect.value == "") {
        showError(tipoPersonaSelect, errorTipoPersonaSelect, "Escoja una tipo de contribuyente");
        esValido = false;
      }
    }

    // Validar campo nombre
    if (nombre.value.trim().length == 0) {
      showError(nombre, errorNombre, "El campo nombre no puede estar vacío");
      esValido = false;
    }

    // Validar campo apellido
    if (apellido.value.trim().length === 0) {
      showError(apellido, errorApellido, "El campo apellido no puede estar vacío");
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

    // Validar provincia
    if (provincia.value === "") {
      showError(provincia, errorProvincia, "Debe seleccionar una provincia");
      esValido = false;
    }

    // Validar cantón
    if (canton.value === "") {
      showError(canton, errorCanton, "Debe seleccionar un cantón");
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
