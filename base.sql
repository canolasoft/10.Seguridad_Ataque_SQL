CREATE DATABASE IF NOT EXISTS base_usuarios;
CREATE TABLE IF NOT EXISTS base_usuarios.usuario (
    id INT(11) NOT NULL AUTO_INCREMENT,
    usr_name VARCHAR(100) NOT NULL,
    usr_email VARCHAR(100) UNIQUE NOT NULL,
    usr_pass VARCHAR(100) NOT NULL,
    imagen VARCHAR(100) DEFAULT NULL,
    PRIMARY KEY (id)
);
# usuarios de prueba
INSERT INTO base_usuarios.usuario (usr_name, usr_email, usr_pass) VALUES
('Usuario1', 'usuario1@example.com', '1234'),
('Usuario2', 'usuario2@example.com', '1234'),
('Usuario3', 'usuario3@example.com', '1234');