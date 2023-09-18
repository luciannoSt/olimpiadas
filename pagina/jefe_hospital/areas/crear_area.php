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

// Obtener el nombre del área desde el formulario
$nombre_area = $_POST["nombre_area"];
$piso_area = $_POST["piso_area"];

// Insertar el área en la base de datos
$sql = "INSERT INTO `zonas` (`id_zona`, `Nombre_zona`, `Piso`) VALUES (NULL, '$nombre_area', '$piso_area');";

if ($conn->query($sql) === TRUE) {
    echo "Área creada con éxito";
} else {
    echo "Error al crear el área: " . $conn->error;
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
