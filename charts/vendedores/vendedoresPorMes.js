Chart.defaults.global.defaultFontFamily =
  '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#292b2c";

var ctxVend = document.getElementById("vendedoresMes");

fetch("../charts/vendedores/vendedoresPorMes.php")
  .then((response) => response.json())
  .then((data) => {
    var myBarChart = new Chart(ctxVend, {
      type: "bar",
      data: {
        labels: data.labels, // Meses cortos
        datasets: [
          {
            label: "Ventas",
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
            label: function (tooltipItem, chartData) {
              const idx = tooltipItem.index;
              const vendedor = data.vendedores[idx];
              const ventas = tooltipItem.yLabel.toLocaleString();
              return `${vendedor}: $${ventas}`;
            },
          },
        },
      },
    });
  })
  .catch((err) =>
    console.error("Error cargando ventas top vendedor por mes:", err)
  );
