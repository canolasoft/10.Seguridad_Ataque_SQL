<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="icon" type="image/x-icon" href="favicon.png">
    <title>Ciberseguridad</title>
    <style>
        em {
            background-color: #c9c9c9ff;
            border-radius: 4px;
            display: block;
            font-family: monospace;
            padding: 10px;
            overflow-x: auto;
            /* Agrega scroll horizontal si es necesario */
            max-width: 100%;
            /* Limita el ancho al contenedor padre */
            box-sizing: border-box;
            /* Incluye el padding en el ancho */
        }
    </style>
</head>

<body class="bg-success bg-opacity-75">
    <div class="container mt-5 bg-light rounded p-5 col-lg-8">
        <img class="col-12 col-lg-6" src="portada.jpg" alt="">
        <h1 class="mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 0a4 4 0 0 1 4 4v2.05a2.5 2.5 0 0 1 2 2.45v5a2.5 2.5 0 0 1-2.5 2.5h-7A2.5 2.5 0 0 1 2 13.5v-5a2.5 2.5 0 0 1 2-2.45V4a4 4 0 0 1 4-4m0 1a3 3 0 0 0-3 3v2h6V4a3 3 0 0 0-3-3" />
            </svg>
            Seguridad: Ataque XSS - inyección SQL
        </h1>
        <p>
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bullseye" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                <path d="M8 13A5 5 0 1 1 8 3a5 5 0 0 1 0 10m0 1A6 6 0 1 0 8 2a6 6 0 0 0 0 12" />
                <path d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6m0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8" />
                <path d="M9.5 8a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
            </svg>
            <strong>Objetivo:</strong> Simular un ataque de inyección de código SQL en un sitio web vulnerable para acceder a información sensible en nombre de otro usuario.
        </p>
        <p>
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
            </svg>
            ¿Qué es una <strong>Inyección SQL</strong>?
            <br>
            Una inyección SQL es un tipo de ataque en el que un atacante inserta o "inyecta" código SQL malicioso en una consulta SQL a través de la entrada de datos de un usuario. Esto puede permitir al atacante manipular la base de datos subyacente, acceder a datos sensibles, o incluso tomar el control total de la base de datos.
        </p>
        <p>
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-database" viewBox="0 0 16 16">
                <path d="M4.318 2.687C5.234 2.271 6.536 2 8 2s2.766.27 3.682.687C12.644 3.125 13 3.627 13 4c0 .374-.356.875-1.318 1.313C10.766 5.729 9.464 6 8 6s-2.766-.27-3.682-.687C3.356 4.875 3 4.373 3 4c0-.374.356-.875 1.318-1.313M13 5.698V7c0 .374-.356.875-1.318 1.313C10.766 8.729 9.464 9 8 9s-2.766-.27-3.682-.687C3.356 7.875 3 7.373 3 7V5.698c.271.202.58.378.904.525C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777A5 5 0 0 0 13 5.698M14 4c0-1.007-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1s-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4v9c0 1.007.875 1.755 1.904 2.223C4.978 15.71 6.427 16 8 16s3.022-.289 4.096-.777C13.125 14.755 14 14.007 14 13zm-1 4.698V10c0 .374-.356.875-1.318 1.313C10.766 11.729 9.464 12 8 12s-2.766-.27-3.682-.687C3.356 10.875 3 10.373 3 10V8.698c.271.202.58.378.904.525C4.978 9.71 6.427 10 8 10s3.022-.289 4.096-.777A5 5 0 0 0 13 8.698m0 3V13c0 .374-.356.875-1.318 1.313C10.766 14.729 9.464 15 8 15s-2.766-.27-3.682-.687C3.356 13.875 3 13.373 3 13v-1.302c.271.202.58.378.904.525C4.978 12.71 6.427 13 8 13s3.022-.289 4.096-.777c.324-.147.633-.323.904-.525" />
            </svg>
            <strong>Base de datos</strong>
            <em>
                CREATE DATABASE IF NOT EXISTS base_usuarios;<br>
                CREATE TABLE IF NOT EXISTS base_usuarios.usuario (<br>
                id INT(11) NOT NULL AUTO_INCREMENT,<br>
                usr_name VARCHAR(100) NOT NULL,<br>
                usr_email VARCHAR(100) UNIQUE NOT NULL,<br>
                usr_pass VARCHAR(100) NOT NULL,<br>
                imagen VARCHAR(100) DEFAULT NULL,<br>
                PRIMARY KEY (id)<br>
                );<br>
                # usuarios de prueba<br>
                INSERT INTO base_usuarios.usuario (usr_name, usr_email, usr_pass) VALUES<br>
                ('Usuario1', 'usuario1@example.com', '1234'),<br>
                ('Usuario2', 'usuario2@example.com', '1234'),<br>
                ('Usuario3', 'usuario3@example.com', '1234');
            </em>
        </p>
        <!--p>
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-keyboard" viewBox="0 0 16 16">
                <path d="M14 5a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1zM2 4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z" />
                <path d="M13 10.25a.25.25 0 0 1 .25-.25h.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-.5a.25.25 0 0 1-.25-.25zm0-2a.25.25 0 0 1 .25-.25h.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-.5a.25.25 0 0 1-.25-.25zm-5 0A.25.25 0 0 1 8.25 8h.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-.5A.25.25 0 0 1 8 8.75zm2 0a.25.25 0 0 1 .25-.25h1.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-1.5a.25.25 0 0 1-.25-.25zm1 2a.25.25 0 0 1 .25-.25h.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-.5a.25.25 0 0 1-.25-.25zm-5-2A.25.25 0 0 1 6.25 8h.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-.5A.25.25 0 0 1 6 8.75zm-2 0A.25.25 0 0 1 4.25 8h.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-.5A.25.25 0 0 1 4 8.75zm-2 0A.25.25 0 0 1 2.25 8h.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-.5A.25.25 0 0 1 2 8.75zm11-2a.25.25 0 0 1 .25-.25h.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-.5a.25.25 0 0 1-.25-.25zm-2 0a.25.25 0 0 1 .25-.25h.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-.5a.25.25 0 0 1-.25-.25zm-2 0A.25.25 0 0 1 9.25 6h.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-.5A.25.25 0 0 1 9 6.75zm-2 0A.25.25 0 0 1 7.25 6h.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-.5A.25.25 0 0 1 7 6.75zm-2 0A.25.25 0 0 1 5.25 6h.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-.5A.25.25 0 0 1 5 6.75zm-3 0A.25.25 0 0 1 2.25 6h1.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-1.5A.25.25 0 0 1 2 6.75zm0 4a.25.25 0 0 1 .25-.25h.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-.5a.25.25 0 0 1-.25-.25zm2 0a.25.25 0 0 1 .25-.25h5.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-5.5a.25.25 0 0 1-.25-.25z" />
            </svg>
            ¿Qué es un <strong>keylogger</strong>?
            <br>
            Un keylogger es un software o dispositivo que registra secretamente cada pulsación de teclas en una computadora o dispositivo móvil, capturando contraseñas, información personal y datos bancarios para enviarlos a un tercero. Son una forma peligrosa de spyware que puede usarse para cometer fraude, robo de identidad y otros delitos.
        </p-->
        <p>
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bug" viewBox="0 0 16 16">
                <path d="M4.355.522a.5.5 0 0 1 .623.333l.291.956A5 5 0 0 1 8 1c1.007 0 1.946.298 2.731.811l.29-.956a.5.5 0 1 1 .957.29l-.41 1.352A5 5 0 0 1 13 6h.5a.5.5 0 0 0 .5-.5V5a.5.5 0 0 1 1 0v.5A1.5 1.5 0 0 1 13.5 7H13v1h1.5a.5.5 0 0 1 0 1H13v1h.5a1.5 1.5 0 0 1 1.5 1.5v.5a.5.5 0 1 1-1 0v-.5a.5.5 0 0 0-.5-.5H13a5 5 0 0 1-10 0h-.5a.5.5 0 0 0-.5.5v.5a.5.5 0 1 1-1 0v-.5A1.5 1.5 0 0 1 2.5 10H3V9H1.5a.5.5 0 0 1 0-1H3V7h-.5A1.5 1.5 0 0 1 1 5.5V5a.5.5 0 0 1 1 0v.5a.5.5 0 0 0 .5.5H3c0-1.364.547-2.601 1.432-3.503l-.41-1.352a.5.5 0 0 1 .333-.623M4 7v4a4 4 0 0 0 3.5 3.97V7zm4.5 0v7.97A4 4 0 0 0 12 11V7zM12 6a4 4 0 0 0-1.334-2.982A3.98 3.98 0 0 0 8 2a3.98 3.98 0 0 0-2.667 1.018A4 4 0 0 0 4 6z" />
            </svg>
            <strong>Código malicioso</strong>
            <br>
            Este sitio web es vulnerable a inyección SQL porque utiliza entradas de usuario sin validar directamente en consultas SQL.
            <br>
            Un atacante puede explotar esta vulnerabilidad para manipular las consultas SQL y acceder a datos no autorizados.
            <br>
            Al colocar el siguiente código en el campo de contraseña del formulario de inicio de sesión: <i class="text-success"><strong>' or ''='</strong></i>.
            <br>
        <div>
            <em>
                <hr>
                // Formulario de inicio de sesión (index.php):
                <div class="col-12 col-lg-6 mt-4 p-4 bg-light rounded">
                    <strong>Iniciar sesión</strong> sin conocer la contraseña de ningún usuario.
                    <br>
                    <label for="exampleInputEmail1" class="form-label mt-2">Email</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" value="usuario1@example.com" disabled>
                    <label for="exampleInputPassword1" class="form-label text-success mt-2"><strong>Contraseña</strong></label>
                    <input type="text" class="form-control text-success" id="exampleInputPassword1" value="' or ''='" disabled>
                    <button class="btn btn-sm btn-primary mt-2" disabled>Iniciar sesión</button>
                </div>
            </em>
        </div>
        <em>
            <hr>
            <p>
                // Código del lado del servidor (Back/login.php):
                <br>
                <span class="text-success"><strong>$password</strong></span> = <span class="text-primary">$_POST[</span><span class="text-danger">'password'</span><span class="text-primary">]</span>;
                <br>
                $query =
                <span class="text-danger">
                    "SELECT * FROM usuario WHERE usr_email = '
                    $email' AND usr_pass = '</span><span class="text-success"><strong>$password</strong></span><span class="text-danger">'"
                </span>
                ;
            </p>
            <p>
                La consulta SQL resultante sería:
                <br>
                <span class="text-danger">
                    SELECT * FROM usuario WHERE usr_email = '<i>usuario1@example.com</i>' AND usr_pass = '<i class="text-success"><strong>' or ''='</strong></i>'
                </span>
            </p>
        </em>
        </p>

        <hr>
        <h1 class="text-center">Sitio web vulnerable</h1>
        <div class="col-12 col-lg-6 mt-4 mx-auto border p-4 rounded">
            <?php
            if (isset($_SESSION['email'])) {
            ?>
                <div id="login" class="text-center">
                    <div class="alert alert-success" role="alert">
                        <?php echo 'Has iniciado sesión como ' . htmlspecialchars($_SESSION['email']) . '.'; ?>
                    </div>
                    <a class="btn btn-danger" href="Back/logout.php">Cerrar sesión</a>
                </div>
            <?php
            } else {
            ?>
                <form id="loginForm" action="Back/login.php" method="POST">
                    <h3>Iniciar sesión</h3>
                    <?php
                    if (isset($_SESSION['mensaje'])) {
                        echo '<div class="alert alert-danger" role="alert">' . htmlspecialchars($_SESSION['mensaje']) . '</div>';
                        unset($_SESSION['mensaje']);
                    }
                    ?>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                </form>
            <?php
            }
            ?>
        </div>
    </div>
</body>

</html>