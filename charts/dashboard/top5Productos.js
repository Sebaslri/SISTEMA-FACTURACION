Chart.defaults.global.defaultFontFamily =
  '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#292b2c";

var ctx3 = document.getElementById("cantidadProducto");

fetch("../charts/dashboard/top5Productos.php")
  .then((response) => response.json())
  .then((data) => {
    // Función para cortar etiquetas largas en varias líneas
    function wrapLabel(label, maxChars = 10) {
      if (label.length <= maxChars) return [label]; // Devuelve array con una línea
      const words = label.split(" ");
      let lines = [];
      let currentLine = "";
      words.forEach((word) => {
        if ((currentLine + " " + word).trim().length <= maxChars) {
          currentLine = (currentLine + " " + word).trim();
        } else {
          lines.push(currentLine);
          currentLine = word;
        }
      });
      lines.push(currentLine);
      return lines; // Array de líneas
    }

    var myBarChart = new Chart(ctx3, {
      type: "bar",
      data: {
        labels: data.labels.map((l) => wrapLabel(l, 10)), // ahora devuelve array
        datasets: [
          {
            label: "Cantidad vendida",
            backgroundColor: [
              "#b8176aff",
              "#17a2b8",
              "#7d28a7ff",
              "#d79a00ff",
              "#174ab8ff",
            ],
            data: data.data,
          },
        ],
      },
      options: {
        scales: {
          xAxes: [
            {
              gridLines: { display: false },
              ticks: {
                autoSkip: false,
                textAlign: "center",
              },
            },
          ],
          yAxes: [
            {
              ticks: {
                beginAtZero: true,
                precision: 0,
                stepSize: 5, // Ajusta según el rango de tus datos
                maxTicksLimit: 5, // Número máximo de etiquetas visibles
              },
              gridLines: { display: true },
            },
          ],
        },
        plugins: {
          legend: { display: false }, // Chart.js v3+
        },
      },
    });
  })
  .catch((err) => console.error("Error cargando productos más vendidos:", err));
