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
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-incognito" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="m4.736 1.968-.892 3.269-.014.058C2.113 5.568 1 6.006 1 6.5 1 7.328 4.134 8 8 8s7-.672 7-1.5c0-.494-1.113-.932-2.83-1.205l-.014-.058-.892-3.27c-.146-.533-.698-.849-1.239-.734C9.411 1.363 8.62 1.5 8 1.5s-1.411-.136-2.025-.267c-.541-.115-1.093.2-1.239.735m.015 3.867a.25.25 0 0 1 .274-.224c.9.092 1.91.143 2.975.143a30 30 0 0 0 2.975-.143.25.25 0 0 1 .05.498c-.918.093-1.944.145-3.025.145s-2.107-.052-3.025-.145a.25.25 0 0 1-.224-.274M3.5 10h2a.5.5 0 0 1 .5.5v1a1.5 1.5 0 0 1-3 0v-1a.5.5 0 0 1 .5-.5m-1.5.5q.001-.264.085-.5H2a.5.5 0 0 1 0-1h3.5a1.5 1.5 0 0 1 1.488 1.312 3.5 3.5 0 0 1 2.024 0A1.5 1.5 0 0 1 10.5 9H14a.5.5 0 0 1 0 1h-.085q.084.236.085.5v1a2.5 2.5 0 0 1-5 0v-.14l-.21-.07a2.5 2.5 0 0 0-1.58 0l-.21.07v.14a2.5 2.5 0 0 1-5 0zm8.5-.5h2a.5.5 0 0 1 .5.5v1a1.5 1.5 0 0 1-3 0v-1a.5.5 0 0 1 .5-.5" />
            </svg>
            La prueba consiste en aprovechar una vulnerabilidad del sitio web de la víctima y mediante <strong>inyección JavaScript</strong> en el formulario de comentarios se coloca un fragmento de código malicioso (keylogger), que luego es ejecutado por el sitio al mostrar los comentarios.
            <br>
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
                <div class="col-12 col-lg-6 mt-4 mx-auto p-4">
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
                    <h1>Iniciar sesión</h1>
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