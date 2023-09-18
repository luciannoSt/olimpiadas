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

// Verifica si se ha proporcionado un ID válido para eliminar
if (isset($_GET["id"])) {
    $id_paciente = $_GET["id"];

    // Consulta SQL para eliminar el paciente por su ID
    $sql = "DELETE FROM paciente WHERE id_paciente = $id_paciente";

    if ($conn->query($sql) === TRUE) {
        echo "Paciente eliminado con éxito.";
    } else {
        echo "Error al eliminar el paciente: " . $conn->error;
    }
} else {
    echo "ID de paciente no proporcionado.";
}

$conn->close();
?>
