// Chart.js defaults
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

var ctxProdDev = document.getElementById("productosDevueltos");

fetch("../charts/devoluciones/productosDevueltos.php")
    .then(response => response.json())
    .then(data => {

        // Función para dividir etiquetas largas en varias líneas
        function wrapLabel(label, maxChars = 12) {
            if (label.length <= maxChars) return [label];
            const words = label.split(' ');
            let lines = [];
            let currentLine = '';
            words.forEach(word => {
                if ((currentLine + ' ' + word).trim().length <= maxChars) {
                    currentLine = (currentLine + ' ' + word).trim();
                } else {
                    lines.push(currentLine);
                    currentLine = word;
                }
            });
            lines.push(currentLine);
            return lines;
        }

        var myBarChart = new Chart(ctxProdDev, {
            type: 'bar',
            data: {
                labels: data.labels.map(l => wrapLabel(l)), // Etiquetas divididas en líneas
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
                        ticks: {
                            autoSkip: false,
                            textAlign: 'center'
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            precision: 0,
                            stepSize: 10,       // Ajusta según tus datos
                            maxTicksLimit: 5
                        }
                    }]
                },
                legend: { display: false },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem) {
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
