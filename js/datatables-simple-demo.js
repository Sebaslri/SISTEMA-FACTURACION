window.addEventListener("DOMContentLoaded", (event) => {
  // Simple-DataTables
  // https://github.com/fiduswriter/Simple-DataTables/wiki

  /* const datatablesSimple = document.getElementById('datatablesSimple');
    if (datatablesSimple) {
        window.datatablesSimpleInstance = new simpleDatatables.DataTable(datatablesSimple);
    }
 */

  const datatablesSimple = document.getElementById("datatablesSimple");

  if (datatablesSimple) {
    const dataTable = new simpleDatatables.DataTable(datatablesSimple);

    // Variable global para el índice de la columna "Estado"
    let estadoColIndex = -1;

    // Función para aplicar clases y ocultar columna
    function actualizarFilasYEfectos() {
      if (estadoColIndex === -1) return;

      // Ocultar columna "Estado" (si no está ya oculto)
      if (!document.getElementById("ocultar-columna-estado")) {
        const style = document.createElement("style");
        style.id = "ocultar-columna-estado";
        style.innerHTML = `
              #datatablesSimple th:nth-child(${estadoColIndex + 1}),
              #datatablesSimple td:nth-child(${estadoColIndex + 1}) {
                display: none;
              }
            `;
        document.head.appendChild(style);
      }

      // Aplicar clase 'inactive-row' a filas con estado=0
      datatablesSimple.querySelectorAll("tbody tr").forEach((row) => {
        const celdaEstado = row.querySelector(
          `td:nth-child(${estadoColIndex + 1})`
        );
        const estado = celdaEstado?.textContent?.trim();

        if (estado === "0") {
          row.classList.add("inactive-row");

          const apagarBtn = row.querySelector(".btn-outline-success");
          const editarBtn = row.querySelector(".btn-primary");          
          if (apagarBtn) {
            apagarBtn.classList.remove("btn-outline-success");
            apagarBtn.classList.add("btn-outline-danger");
            editarBtn.classList.remove("btn-primary");
            editarBtn.classList.add("btn-secondary");
          }
        } else {
          // Por si cambió el estado, remover clase y revertir botón
          row.classList.remove("inactive-row");

          const apagarBtn = row.querySelector(".btn-outline-danger");
          if (apagarBtn) {
            apagarBtn.classList.remove("btn-outline-danger");
            apagarBtn.classList.add("btn-outline-success");
            editarBtn.classList.remove("btn-secondary");
            editarBtn.classList.add("btn-primary");
          }
        }
      });
    }

    // Evento inicial (tabla cargada)
    dataTable.on("datatable.init", () => {
      // Obtener índice de columna "Estado"
      const headers = datatablesSimple.querySelectorAll("thead th");
      estadoColIndex = -1;

      headers.forEach((th, index) => {
        if (th.textContent.trim().toLowerCase() === "estado") {
          estadoColIndex = index;
        }
      });

      actualizarFilasYEfectos();
    });

    // Eventos para cuando cambies página o busques
    dataTable.on("datatable.page", () => {
      actualizarFilasYEfectos();
    });

    dataTable.on("datatable.search", () => {
      actualizarFilasYEfectos();
    });
  }

  /* const datatablesSimple = document.getElementById('datatablesSimple');
    if (datatablesSimple) {
        const dataTable = new simpleDatatables.DataTable(datatablesSimple);

        dataTable.on('datatable.init', () => {
            document.querySelectorAll('#datatablesSimple tbody tr').forEach(row => {
                const estadoCelda = row.querySelector('td:nth-child(7)');
                const estado = estadoCelda?.textContent?.trim();

                if (estado === '0') {
                    row.classList.add('inactive-row');

                    // Cambiar botón de apagado a rojo
                    const apagarBtn = row.querySelector('.btn-outline-success');
                    if (apagarBtn) {
                        apagarBtn.classList.remove('btn-outline-success');
                        apagarBtn.classList.add('btn-outline-danger');
                    }
                }
            });
        });
    } */

  /*const datatablesSimple = document.getElementById('datatablesSimple');

    if (datatablesSimple) {
        const dataTable = new simpleDatatables.DataTable(datatablesSimple);

        dataTable.on('datatable.init', () => {
            const headers = datatablesSimple.querySelectorAll('thead th');
            let estadoColIndex = -1;

            headers.forEach((th, index) => {
                if (th.textContent.trim().toLowerCase() === 'estado') {
                    estadoColIndex = index;
                }
            });

            if (estadoColIndex === -1) return;

            // Agregar clase a filas con estado = 0
            datatablesSimple.querySelectorAll('tbody tr').forEach(row => {
                const celdaEstado = row.querySelector(`td:nth-child(${estadoColIndex + 1})`);
                const estado = celdaEstado?.textContent?.trim();

                if (estado === '0') {
                    row.classList.add('inactive-row');

                    const apagarBtn = row.querySelector('.btn-outline-success');
                    if (apagarBtn) {
                        apagarBtn.classList.remove('btn-outline-success');
                        apagarBtn.classList.add('btn-outline-danger');
                    }
                }
            });

            // Ocultar columna "Estado"
            const colNum = estadoColIndex + 1;
            const style = document.createElement('style');
            style.innerHTML = `
            #datatablesSimple th:nth-child(${colNum}),
            #datatablesSimple td:nth-child(${colNum}) {
                display: none;
            }
            `;
            document.head.appendChild(style);
        });
    } */
});
