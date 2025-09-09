// Defaults de Chart.js como Bootstrap
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

var ctx = document.getElementById("clasificacionProve");

fetch("../charts/proveedores/clasificacionProve.php")
    .then(response => response.json())
    .then(data => {
        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: data.labels,
                datasets: [{
                    data: data.data,
                    backgroundColor: [
                        '#007bff', '#dc3545', '#ffc107', '#28a745', '#17a2b8',
                        '#6f42c1', '#fd7e14', '#20c997', '#6610f2', '#e83e8c'
                    ],
                }],
            },
            options: {
                legend: {
                    display: true,
                    position: 'top'
                }
            }
        });
    })
    .catch(err => console.error("Error cargando proveedores por tipo:", err));