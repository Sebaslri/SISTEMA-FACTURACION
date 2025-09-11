var ctxProductos = document.getElementById("productosChart");

fetch("../charts/productos/productosSemana.php")
  .then((response) => response.json())
  .then((json) => {
    new Chart(ctxProductos, {
      type: "line",
      data: {
        labels: json.labels,
        datasets: [
          {
            label: "Productos vendidos",
            lineTension: 0.3,
            backgroundColor: "rgba(2,117,216,0.2)",
            borderColor: "rgba(2,117,216,1)",
            pointRadius: 5,
            pointBackgroundColor: "rgba(2,117,216,1)",
            pointBorderColor: "rgba(255,255,255,0.8)",
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(2,117,216,1)",
            pointHitRadius: 50,
            pointBorderWidth: 2,
            data: json.productos,
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        tooltips: {
          mode: "index",
          intersect: false,
          callbacks: {
            label: function (tooltipItem, data) {
              return tooltipItem.value + " productos";
            },
          },
        },
        scales: {
          xAxes: [
            {
              gridLines: { display: false },
              ticks: { maxTicksLimit: 7 },
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
      },
    });
  })
  .catch((err) => console.error("Error cargando productos:", err));
