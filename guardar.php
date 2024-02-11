<?php
// Obtener los valores enviados desde el formulario
$nombre = $_POST['Nombre'];
$telefono = $_POST['Telefono'];
$correo = $_POST['Correo'];
$mensaje = $_POST['Mensaje'];

// Conexión a la base de datos
$servername = "localhost"; // Cambia esto si tu servidor de base de datos es diferente
$username = "root"; // Cambia esto por tu nombre de usuario de la base de datos
$password = ""; // Cambia esto por tu contraseña de la base de datos
$dbname = "formulario";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error en la conexión a la base de datos: " . $conn->connect_error);
}

// Preparar y ejecutar la consulta para insertar los datos en la tabla "datos"
$sql = "INSERT INTO datos (Nombre, Telefono, Correo, Mensaje) VALUES ('$nombre', '$telefono', '$correo', '$mensaje')";

$verificar_correo = mysqli_query($conn,"SELECT * FROM datos WHERE Correo = '$correo'");

if (mysqli_num_rows($verificar_correo) > 0) {
    echo '<script>    
         alert("El correo ya existe");
         window.history.go(-1);
    </script>';  
    exit;
}
// Ejecutar consulta
$resultado = mysqli_query($conn,$insertar);
if (!$resultado) {
    echo '<script> 
            alert("Error de registro");
            window.history.go(-1);
        </script>';
} else {
    echo '<script> 
            alert("Registro efecturado correctamente");
            window.history.go(-1);
        </script>';   
}
// Cerrar consultas
mysqli_close($conn);

// Cerrar la conexión
$conn->close();
?>
