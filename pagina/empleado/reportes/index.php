<!DOCTYPE html>
<html>
<head>
    <title>Reportes</title>
</head>
<body>
    <h1>Reportes</h1>

    <!-- Formulario de búsqueda -->
    <form method="POST" action="buscar_reporte.php">
        <label for="area">Área:</label>
        <input type="text" name="area" id="area" placeholder="Ingrese el nombre del área"><br>

        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" id="fecha"><br>

        <label for="estado_llamado">Tipo de Llamado:</label>
        <input type="number" name="estado_llamado">

        <input type="submit" value="Buscar">
    </form>

    <!-- Tabla de resultados -->
    <table border="1">
        <tr>
            <th>ID Reporte</th>
            <th>Nombre del Paciente</th>
            <th>Zona</th>
            <th>Fecha</th>
            <th>Descripción</th>
        </tr>
        <?php
        // Establecer conexión a la base de datos (debes proporcionar tus propios datos de conexión)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "hospital";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Variables para la búsqueda
        $area = isset($_POST['area']) ? $_POST['area'] : '';
        $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : '';
        $estado_llamado = isset($_POST['estado_llamado']) ? $_POST['estado_llamado'] : '';

        // Consulta SQL para obtener los reportes según los criterios de búsqueda
        $sql = "SELECT reportes.id_reportes, persona.Nombre AS nombre_paciente, zonas.Nombre_zona, reportes.fecha, reportes.descripcion
                FROM reportes
                LEFT JOIN persona ON persona.id_persona = reportes.id_paciente
                LEFT JOIN zonas ON zonas.id_zona = reportes.id_zona
                WHERE (zonas.Nombre_zona LIKE '%$area%')
                OR (reportes.fecha LIKE '$fecha')
                OR (reportes.id_llamado = '$estado_llamado')";

        $result = $conn->query($sql);

        // Mostrar los resultados en la tabla
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id_reportes"] . "</td>";
                echo "<td>" . $row["nombre_paciente"] . "</td>";
                echo "<td>" . $row["Nombre_zona"] . "</td>";
                echo "<td>" . $row["fecha"] . "</td>";
                echo "<td>" . $row["descripcion"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No se encontraron reportes según los criterios de búsqueda.</td></tr>";
        }

        // Cerrar la conexión a la base de datos
        $conn->close();
        ?>
    </table>
    <!-- Botón de impresión -->
<button onclick="imprimirPagina()">Imprimir</button>
<script>
function imprimirPagina() {
    // Oculta el botón de impresión para evitar que se imprima
    var botonImpresion = document.querySelector("button");
    botonImpresion.style.display = "none";

    // Llama a la función de impresión del navegador
    window.print();

    // Vuelve a mostrar el botón después de la impresión
    botonImpresion.style.display = "block";
}
</script>

</body>
</html>
