<?php
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospital";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT fecha, COUNT(*) as total_reportes FROM reportes WHERE fecha BETWEEN '$fecha_inicio' AND '$fecha_fin' GROUP BY fecha;";

$result = $conn->query($sql);
// Puedes procesar los resultados aquí
?>

<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
    <title>Resultados de Estadísticas</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <h1>Resultados de la estadística</h1>
    <canvas id="myChart"></canvas>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');

        var labels = [];
        var data = [];

        <?php
        while ($row = $result->fetch_assoc()) {
            $fecha = $row['fecha'];
            $totalPedidos = $row['total_reportes'];

            echo "labels.push('$fecha');";
            echo "data.push($totalPedidos);";
        }
        ?>

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Pedidos por Día',
                    data: data,
                    backgroundColor: '#fbff00af',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <!-- Botón de Inicio -->



</body>
</html>