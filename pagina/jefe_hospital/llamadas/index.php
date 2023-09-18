<!DOCTYPE html>
<html>
<head>
    <title>Estadísticas de Llamadas</title>
</head>
<body>
    <h1>Estadísticas de Llamadas</h1>

    <?php
    // Conexión a la base de datos (debes proporcionar tus propios datos de conexión)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hospital";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consulta SQL para obtener el total de llamadas
    $sql_total_llamadas = "SELECT COUNT(`id_llamado`) AS total_llamadas FROM llamado";
    $result_total_llamadas = $conn->query($sql_total_llamadas);

    // Consulta SQL para obtener el total de llamadas atendidas
    $sql_llamadas_atendidas = "SELECT COUNT(`id_estado_llamado`) AS llamadas_atendidas FROM llamado WHERE id_estado_llamado=1";
    $result_llamadas_atendidas = $conn->query($sql_llamadas_atendidas);

    // Consulta SQL para obtener el total de llamadas no atendidas
    $sql_llamadas_no_atendidas = "SELECT COUNT(`id_estado_llamado`) AS llamadas_no_atendidas FROM llamado WHERE id_estado_llamado=2";
    $result_llamadas_no_atendidas = $conn->query($sql_llamadas_no_atendidas);

    // Obtener los resultados de las consultas
    $row_total_llamadas = $result_total_llamadas->fetch_assoc();
    $row_llamadas_atendidas = $result_llamadas_atendidas->fetch_assoc();
    $row_llamadas_no_atendidas = $result_llamadas_no_atendidas->fetch_assoc();

    // Cerrar la conexión a la base de datos
    $conn->close();
    ?>

    <h2>Estadísticas de Llamadas</h2>
    <p>Total de Llamadas: <?php echo $row_total_llamadas["total_llamadas"]; ?></p>
    <p>Llamadas Atendidas: <?php echo $row_llamadas_atendidas["llamadas_atendidas"]; ?></p>
    <p>Llamadas No Atendidas: <?php echo $row_llamadas_no_atendidas["llamadas_no_atendidas"]; ?></p>
</body>
</html>
