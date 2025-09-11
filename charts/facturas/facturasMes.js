// Chart.js defaults
Chart.defaults.global.defaultFontFamily =
  '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#292b2c";

var ctxFact = document.getElementById("facturasMes");

fetch("../charts/facturas/facturasMes.php")
  .then((response) => response.json())
  .then((data) => {
    var myBarChart = new Chart(ctxFact, {
      type: "bar",
      data: {
        labels: data.labels, // Meses cortos
        datasets: [
          {
            label: "Facturas generadas",
            backgroundColor: "rgba(2,117,216,0.8)",
            borderColor: "rgba(2,117,216,1)",
            data: data.data,
          },
        ],
      },
      options: {
        scales: {
          xAxes: [
            {
              gridLines: { display: false },
              ticks: { maxTicksLimit: 6 },
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
        legend: { display: false },
        tooltips: {
          callbacks: {
            label: function (tooltipItem) {
              return `Facturas: ${tooltipItem.yLabel}`;
            },
          },
        },
      },
    });
  })
  .catch((err) => console.error("Error cargando facturas por mes:", err));
