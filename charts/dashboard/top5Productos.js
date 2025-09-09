Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

var ctx3 = document.getElementById("cantidadProducto");

fetch("../charts/dashboard/top5Productos.php")
    .then(response => response.json())
    .then(data => {
        var myBarChart = new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: data.labels,
                datasets: [{
                    label: "Cantidad vendida",
                    backgroundColor: ["#b8176aff","#17a2b8","#7d28a7ff","#d79a00ff","#174ab8ff"],
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
                legend: { display: false }
            }
        });
    })
    .catch(err => console.error("Error cargando productos más vendidos:", err));
