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

// Obtener la lista de pacientes desde la base de datos
$pacientes = array();
$sql_pacientes = "SELECT `id_paciente`, persona.Nombre FROM paciente LEFT JOIN persona on persona.id_persona = paciente.id_persona;";
$result_pacientes = $conn->query($sql_pacientes);
if ($result_pacientes->num_rows > 0) {
    while ($row = $result_pacientes->fetch_assoc()) {
        $pacientes[$row["id_paciente"]] = $row["Nombre"];
    }
}

// Obtener la lista de zonas desde la base de datos
$zonas = array();
$sql_zonas = "SELECT * FROM `zonas` WHERE 1";
$result_zonas = $conn->query($sql_zonas);
if ($result_zonas->num_rows > 0) {
    while ($row = $result_zonas->fetch_assoc()) {
        $zonas[$row["id_zona"]] = $row["Nombre_zona"] ;
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Asignar Paciente a Zona</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body class="bg">
    <div class="cardTitulo">
        <h1 class="titulo">Asignar Paciente a Zona</h1>
    </div>
    <div class="container">
        <div class="cardformularios">
            <div class="container">
                <form action="procesar_asignacion.php" method="POST">
                    <p>Paciente:</p>
                    <select name="paciente_id" class="inputs">
                        <?php
                        foreach ($pacientes as $id => $nombre) {
                            echo "<option value='$id'>$nombre</option>";
                        }
                        ?>
                    </select>
                    <br>
                    <p>Zona:</p>
                    <select name="zona_id" class="inputs">
                        <?php
                        foreach ($zonas as $id => $nombre) {
                            echo "<option value='$id'>$nombre</option>";
                        }
                        ?>
                    </select>
                    <br>    
                    <br>
                    <input type="submit" class="boton" value="Asignar Paciente">
                </form>
            </div>
            
        </div>
            
    </div>
    
</body>
</html>
