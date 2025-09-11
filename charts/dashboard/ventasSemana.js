var ctxVentas = document.getElementById("ventasChart");

fetch("../charts/dashboard/ventasSemana.php")
  .then(response => response.json())
  .then(json => {
    new Chart(ctxVentas, {
      type: 'line',
      data: {
        labels: json.labels,
        datasets: [{
          label: "Ventas ($)",
          lineTension: 0.3,
          backgroundColor: "rgba(40,167,69,0.2)",
          borderColor: "rgba(40,167,69,1)",
          pointRadius: 5,
          pointBackgroundColor: "rgba(40,167,69,1)",
          pointBorderColor: "rgba(255,255,255,0.8)",
          pointHoverRadius: 5,
          pointHoverBackgroundColor: "rgba(40,167,69,1)",
          pointHitRadius: 50,
          pointBorderWidth: 2,
          data: json.ventas
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        tooltips: {
          mode: 'index',
          intersect: false,
          callbacks: {
            label: function(tooltipItem, data) {
              return "$" + tooltipItem.value;
            }
          }
        },
        scales: {
          xAxes: [{
            gridLines: { display: false },
            ticks: { maxTicksLimit: 7 }
          }],
          yAxes: [{
            ticks: {
              beginAtZero: true,
              callback: value => '$' + value,
              stepSize: 100,     // Intervalo entre etiquetas (ajústalo según tus datos)
              maxTicksLimit: 5   // Máximo número de etiquetas visibles
            },
            gridLines: { color: "rgba(0, 0, 0, .125)" }
          }]
        }
      }
    });
  })
  .catch(err => console.error("Error cargando ventas:", err));
