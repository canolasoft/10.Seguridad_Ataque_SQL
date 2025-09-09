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
    /* Consulta segura contra inyección SQL
    $stmt = $conn->prepare("SELECT * FROM usuario WHERE usr_email = ? AND usr_pass = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    /*/

    //* Consulta vulnerable a inyección SQL
    $query = "SELECT * FROM usuario WHERE usr_email = '$email' AND usr_pass = '$password'";
    error_log("Executing query: $query");
    $result = mysqli_query($conn, $query);
    //*/

    if ($result && mysqli_num_rows($result) > 0) {
        $_SESSION['email'] = $email;
        $_SESSION['mensaje'] = "Login exitoso, Bienvenido " . htmlspecialchars($email) . "!";
        header("Location: ../index.php#login");
        exit();
    } else {
        $_SESSION['mensaje'] = "Correo electrónico o contraseña inválidos.";
    }
    mysqli_close($conn);
} else {
    $_SESSION['mensaje'] = "Por favor, complete todos los campos.";
}
header("Location: ../index.php#loginForm");
exit();

?>