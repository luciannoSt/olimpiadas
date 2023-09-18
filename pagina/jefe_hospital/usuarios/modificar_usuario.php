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
    $id_modificar = $_POST["id_modificar"];
    $nuevo_nombre = $_POST["nuevo_nombre"];
    $nuevo_email = $_POST["nuevo_email"];

    // Actualizar el usuario en la base de datos
    $sql = "UPDATE usuario SET Nombre_usuario='$nuevo_nombre', Clave='$nuevo_email' WHERE id_usuario=$id_modificar";

    if ($conn->query($sql) === TRUE) {
        echo "Usuario modificado con éxito";
    } else {
        echo "Error al modificar usuario: " . $conn->error;
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
}
?>
