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

    // Obtener el ID del usuario a eliminar
    $id_eliminar = $_POST["id_eliminar"];

    // Eliminar el usuario de la base de datos
    $sql = "DELETE FROM usuario WHERE id_usuario=$id_eliminar";

    if ($conn->query($sql) === TRUE) {
        echo "Usuario eliminado con éxito";
    } else {
        echo "Error al eliminar usuario: " . $conn->error;
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
}
?>
