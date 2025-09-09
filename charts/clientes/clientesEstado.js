// Chart.js defaults
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

var ctxClientesEstado = document.getElementById("clientesEstado");

fetch("../charts/clientes/clientesEstado.php")
    .then(response => response.json())
    .then(data => {
        var myClientesPieChart = new Chart(ctxClientesEstado, {
            type: 'pie',
            data: {
                labels: data.labels, // ["Activos", "Inactivos"]
                datasets: [{
                    data: data.data,   // [activos, inactivos]
                    backgroundColor: ['#28a745', '#dc3545'], // Verde = Activos, Rojo = Inactivos
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
    .catch(err => console.error("Error cargando clientes:", err));
