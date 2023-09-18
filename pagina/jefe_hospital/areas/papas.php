<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Gestión de Áreas y Asignación</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="cardTitulo">
        <div class="container">
            <div style="margin-left: -450px;">
                <input type="submit" value="Atras" class="Botonatras" onClick="history.go(-1);">
            </div>
            <div style="margin-left: 350px;">
                <h1 class="titulo">Gestión de Áreas y Asignación</h1>    
            </div>
        </div>
        
    </div>
    <div class="container">
        <div class="cardareas" style="margin-top: 30px;">
            <div class="containesp">
                    <h2 class="tituloassoc">Crear Área</h2>
                    <form action="crear_area.php" method="POST">
                        <p class="assocform">Nombre de la Zona: <input type="text" class="inputs" name="nombre_area"></p>
                        <p class="assocform">Piso de la Zona: <input type="number" class="inputs" name="piso_area"></p>
                        <input type="submit" value="Crear Área" class="botonmini">
                    </form>
    
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
    <meta charset="utf-8">
    <title>Gestión de Áreas y Asignación</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<h1 class="tituloassoc">Asignar Paciente a Zona</h1>
    <form action="procesar_asignacion.php" method="POST">
        <p class="assocform">Paciente:
        <select name="paciente_id" class="inputs">
            <?php
            foreach ($pacientes as $id => $nombre) {
                echo "<option value='$id'>$nombre</option>";
            }
            ?>
        </select></p>
        <p class="assocform">Zona:
        <select name="zona_id" class="inputs">
            <?php
            foreach ($zonas as $id => $nombre) {
                echo "<option value='$id'>$nombre</option>";
            }
            ?>
        </select></p>
        <input type="submit" value="Asignar Paciente" class="botonmini">
    </form>
</body>
</html>
    
    
    
<h2 class="tituloassoc">Realizar Llamado</h2>
    <form action="realizar_llamado.php" method="POST">
        <p class="assocform">Área:
        <select name="area_id" class="inputs">
            <!-- Aquí cargarías dinámicamente la lista de áreas desde la base de datos -->
            <option value="1">Área 1</option>
            <option value="2">Área 2</option>
            <!-- ... -->
        </select></p>
        <input type="submit" value="Realizar Llamado" class="botonmini">
    </form>s
</body>
</html>
