<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forces et Faiblesses des Notes</title>

    <!-- Inclure Bootstrap via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Inclure Chart.js via CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        /* Style soft et léger */
        body {
            /* background-color: #f8f9fa; */
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        .chart-container {
            width: 60%;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Force et Faiblesses des Notes</h1>

        <div class="chart-container">
            <!-- Canvas pour le diagramme radar -->
            <canvas id="notesRadarChart"></canvas>
        </div>
    </div>

    <script>
        // Quand le document est chargé, on crée le diagramme radar
        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('notesRadarChart').getContext('2d');
            var radarChart = new Chart(ctx, {
                type: 'radar',
                data: {
                    labels: ['Algorithm et Complexité', 'Administration BD', 'Génie Logiciel', 'Admin. Systeme et Réseau', 'Algèbre Linéaire', 'Droit'], // Matières
                    datasets: [{
                        label: 'Notes de l\'étudiant',
                        data: [15, 18, 17, 14, 17, 11], // Notes
                        backgroundColor: 'rgba(75, 192, 192, 0.2)', // Couleur d'arrière-plan du diagramme
                        borderColor: 'rgba(75, 192, 192, 1)', // Couleur de la bordure
                        borderWidth: 2,
                        pointBackgroundColor: 'rgba(75, 192, 192, 1)', // Couleur des points
                        pointBorderColor: '#fff', // Bordure des points
                        pointHoverBackgroundColor: '#fff', // Couleur des points au survol
                        pointHoverBorderColor: 'rgba(75, 192, 192, 1)' // Bordure des points au survol
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        r: {
                            angleLines: {
                                display: true
                            },
                            suggestedMin: 0, // Minimum sur l'axe
                            suggestedMax: 20 // Maximum sur l'axe (pour refléter les notes sur 20)
                        }
                    },
                    plugins: {
                        legend: {
                            display: false // Cacher la légende si nécessaire
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>
