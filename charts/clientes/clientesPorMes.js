Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

var ctx2 = document.getElementById("myBarChart");

fetch("../charts/clientes/clientesPorMes.php")
    .then(response => response.json())
    .then(data => {
        var myBarChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: data.labels, // meses en español
                datasets: [{
                    label: "Clientes registrados",
                    backgroundColor: "rgba(2,117,216,0.8)",
                    borderColor: "rgba(2,117,216,1)",
                    data: data.data,
                }],
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
                        gridLines: { display: true }
                    }]
                },
                legend: { display: false }
            }
        });
    })
    .catch(err => console.error("Error cargando clientes últimos 6 meses:", err));
