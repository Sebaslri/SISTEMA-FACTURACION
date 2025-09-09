// Chart.js defaults para que se parezca a Bootstrap
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

var ctxVendEstado = document.getElementById("vendedoresEstado");

fetch("../charts/vendedores/vendedoresEstado.php")
    .then(response => response.json())
    .then(data => {
        var myVendedoresPieChart = new Chart(ctxVendEstado, {
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
    .catch(err => console.error("Error cargando vendedores:", err));
