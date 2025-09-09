// Chart.js defaults
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

var ctxDevo = document.getElementById("devolucionesMes");

fetch("../charts/devoluciones/devolucionesMes.php")
    .then(response => response.json())
    .then(data => {
        var myLineChart = new Chart(ctxDevo, {
            type: 'line',
            data: {
                labels: data.labels, // Meses cortos
                datasets: [{
                    label: "Total devuelto",
                    data: data.totales,
                    borderColor: "rgba(220,53,69,1)",   // Rojo
                    backgroundColor: "rgba(220,53,69,0.2)", // Fondo suave
                    fill: true,
                    lineTension: 0.3,
                    pointRadius: 5,
                    pointBackgroundColor: "rgba(220,53,69,1)",
                    pointBorderColor: "rgba(220,53,69,0.8)",
                    pointHoverRadius: 7,
                    pointHitRadius: 10,
                    pointBorderWidth: 2
                }]
            },
            options: {
                scales: {
                    xAxes: [{
                        gridLines: { display: false },
                        ticks: { maxTicksLimit: 6 }
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            precision: 0
                        },
                        gridLines: { color: "rgba(0, 0, 0, .125)" }
                    }]
                },
                legend: { display: false },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, chartData) {
                            const idx = tooltipItem.index;
                            const total = tooltipItem.yLabel.toLocaleString();
                            const productos = data.cantidades[idx];
                            return `Total: $${total} | Productos: ${productos}`;
                        }
                    }
                }
            }
        });
    })
    .catch(err => console.error("Error cargando devoluciones por mes:", err));
