// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

var ctx = document.getElementById("myPieChart");

fetch("../charts/clientes/clientesTop5Compras.php") // tu archivo PHP
    .then(response => response.json())
    .then(data => {        
        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: data.labels,
                datasets: [{
                    data: data.data,
                    backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745', '#17a2b8'],
                }],
            },
        });
    });

    
