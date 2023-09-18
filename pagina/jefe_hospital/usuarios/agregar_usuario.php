<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Obtener los datos del formulario
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];

    // Insertar el usuario en la base de datos
    $sql = "INSERT INTO `usuario` (`id_usuario`, `Nombre_usuario`, `Clave`, `Fecha_registro`) VALUES (NULL, '$nombre', '$email', CURDATE());
    ";

    if ($conn->query($sql) === TRUE) {
        echo "Usuario agregado con éxito";
    } else {
        echo "Error al agregar usuario: " . $conn->error;
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
}
?>
