<!DOCTYPE html>
<html>
<head>
    <title>Resultado de la Consulta</title>
</head>
<body>
    <h1>Resultado de la Consulta</h1>

    <table border="1">
        <tr>
            <th>Numero de  Reporte</th>
            <th>Tardanza</th>
        </tr>
        <?php
        // Establecer la conexión a la base de datos (reemplaza con tus propios datos)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "hospital";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Consulta SQL
        $sql = "SELECT reportes.id_reportes, TIMEDIFF(reportes.fecha, llamado.fecha) AS diferencia_tiempo
                FROM reportes AS llamado
                INNER JOIN reportes ON llamado.id_llamado = reportes.id_llamado";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id_reportes"] . "</td>";
                echo "<td>" . $row["diferencia_tiempo"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='2'>No se encontraron resultados.</td></tr>";
        }

        // Cerrar la conexión a la base de datos
        $conn->close();
        ?>
    </table>
</body>
</html>
