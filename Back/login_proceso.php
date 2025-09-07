<?php

session_start();

// Procesa el formulario de login
if ($_SERVER['REQUEST_METHOD'] === 'POST'
&& isset($_POST['email'])
&& isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $hostname = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $database = 'base_usuarios';
    $conn = mysqli_connect($hostname, $dbUsername, $dbPassword, $database);
    if (!$conn) {
        die('Connection failed: ' . mysqli_connect_error());
    }
    // Consulta vulnerable a inyección SQL
    $query = "SELECT * FROM usuario WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $_SESSION['email'] = $email;
        echo "Login exitoso, Bienvenido " . htmlspecialchars($email) . "!";
    } else {
        echo "Correo electrónico o contraseña inválidos.";
    }
    mysqli_close($conn);
} else {
    echo "Por favor, envía el formulario de login.";
}

?>