<!DOCTYPE html>
<html>
<head>
    <title>Tabla de Pacientes</title>
</head>
<body>
    <h1>Tabla de Pacientes</h1>

    <!-- Botón para agregar paciente -->
    <a href="agregar_paciente.php">Agregar Paciente</a>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Zona</th>
            <th>Estado de Llegada</th>
            <th>Método de Llegada</th>
            <th>Nombre del Paciente</th>
            <th>Obra Social</th>
            <th>Acciones</th>
        </tr>
        <?php
        // Realiza la conexión a la base de datos (reemplaza con tus propios datos de conexión)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "hospital";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Consulta SQL para obtener datos de pacientes
        $sql = "SELECT paciente.id_paciente, zonas.Nombre_zona, paciente.Estado_llegada, paciente.Metodo_llegada, persona.Nombre, obra_social.Obra_social FROM paciente INNER JOIN zonas ON paciente.id_zona = zonas.id_zona INNER JOIN persona ON paciente.id_persona = persona.id_persona INNER JOIN obra_social ON paciente.id_obra_social = obra_social.id_obra_social";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id_paciente"] . "</td>";
                echo "<td>" . $row["Nombre_zona"] . "</td>";
                echo "<td>" . $row["Estado_llegada"] . "</td>";
                echo "<td>" . $row["Metodo_llegada"] . "</td>";
                echo "<td>" . $row["Nombre"] . "</td>";
                echo "<td>" . $row["Obra_social"] . "</td>";
                echo "<td>";
                echo "<a href='editar_paciente.php?id=" . $row["id_paciente"] . "'>Editar</a> ";
                echo "<a href='eliminar_paciente.php?id=" . $row["id_paciente"] . "'>Eliminar</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No se encontraron pacientes.</td></tr>";
        }

        $conn->close();
        ?>
    </table>
</body>
</html>
