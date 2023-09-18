<!DOCTYPE html>
<html>
<head>
    <title>Formulario para Agregar Paciente</title>
</head>
<body>
    <h1>Agregar Paciente</h1>

    <form action="guardar_paciente.php" method="post">
       

        <!-- Campo para seleccionar el Método de Llegada -->
        <label for="metodo_llegada">Método de Llegada:</label>
        <input type="text" name="metodo_llegada">
        <br>

        <!-- Campo para seleccionar el Estado de Llegada -->
        <label for="estado_llegada">Estado de Llegada:</label>
     <input type="text" name="estado_llegada">
        <br>

        <!-- Campo para seleccionar la Zona desde la base de datos -->
        <label for="id_zona">Zona:</label>
        <select name="id_zona">
            <?php
            // Conexión a la base de datos (reemplaza con tus propios datos de conexión)
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "hospital";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }

            // Consulta SQL para obtener las zonas desde la base de datos
            $sql = "SELECT id_zona, Nombre_zona FROM zonas";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["id_zona"] . "'>" . $row["Nombre_zona"] . "</option>";
                }
            } else {
                echo "<option value=''>No se encontraron zonas</option>";
            }

            $conn->close();
            ?>
        </select><br>

        <!-- Campo para seleccionar la Persona desde la base de datos -->
        <label for="id_persona">Persona:</label>
        <select name="id_persona">
            <?php
            // Conexión a la base de datos (reemplaza con tus propios datos de conexión)
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }

            // Consulta SQL para obtener las personas desde la base de datos
            $sql = "SELECT `id_persona`,`Nombre` FROM `persona`";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["id_persona"] . "'>" . $row["Nombre"] . "</option>";
                }
            } else {
                echo "<option value=''>No se encontraron personas</option>";
            }

            $conn->close();
            ?>
        </select><br>

        <!-- Campo para seleccionar la Obra Social desde la base de datos -->
        <label for="id_obra_social">Obra Social:</label>
        <select name="id_obra_social">
            <?php
            // Conexión a la base de datos (reemplaza con tus propios datos de conexión)
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }

            // Consulta SQL para obtener las obras sociales desde la base de datos
            $sql = "SELECT `id_obra_social`,`Obra_social` FROM `obra_social`";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["id_obra_social"] . "'>" . $row["Obra_social"] . "</option>";
                }
            } else {
                echo "<option value=''>No se encontraron obras sociales</option>";
            }

            $conn->close();
            ?>
        </select><br>

        <!-- Otros campos de datos personales y médicos -->

        <input type="submit" value="Guardar">
    </form>
</body>
</html>
