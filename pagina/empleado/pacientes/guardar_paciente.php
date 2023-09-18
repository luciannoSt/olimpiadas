<?php
// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera los datos del formulario
    $metodo_llegada = $_POST["metodo_llegada"];
    
    $estado_llegada = $_POST["estado_llegada"];
    
    $id_zona = $_POST["id_zona"];
    
    $id_persona = $_POST["id_persona"];
    
    $id_obra_social = $_POST["id_obra_social"];
    

    // Conexión a la base de datos (reemplaza con tus propios datos de conexión)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hospital";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consulta SQL para insertar el paciente en la base de datos
    $sql = "INSERT INTO paciente ( Metodo_llegada, Estado_llegada, id_zona, id_persona, id_obra_social)
            VALUES ( '$metodo_llegada', '$estado_llegada', $id_zona, $id_persona, $id_obra_social)";

    if ($conn->query($sql) === TRUE) {
        echo "Paciente agregado con éxito.";
    } else {
        echo "Error al agregar el paciente: " . $conn->error;
    }

    $conn->close();
} else {
    echo "No se han recibido datos del formulario.";
}
?>
