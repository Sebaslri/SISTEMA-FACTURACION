// Chart.js defaults
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

var ctxProdDev = document.getElementById("productosDevueltos");

fetch("../charts/devoluciones/productosDevueltos.php")
    .then(response => response.json())
    .then(data => {
        var myBarChart = new Chart(ctxProdDev, {
            type: 'bar',
            data: {
                labels: data.labels, // Nombres de los productos
                datasets: [{
                    label: "Cantidad devuelta",
                    backgroundColor: ["#b8176aff", "#17a2b8", "#7d28a7ff", "#d79a00ff", "#174ab8ff"],
                    data: data.data,
                }],
            },
            options: {
                scales: {
                    xAxes: [{
                        gridLines: { display: false },
                        ticks: { autoSkip: false }
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            precision: 0
                        }
                    }]
                },
                legend: { display: false },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, chartData) {
                            const idx = tooltipItem.index;
                            const producto = data.labels[idx];
                            const cantidad = tooltipItem.yLabel.toLocaleString();
                            return `${producto}: ${cantidad} unidades`;
                        }
                    }
                }
            }
        });
    })
    .catch(err => console.error("Error cargando productos devueltos:", err));
