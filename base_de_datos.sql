CREATE TABLE usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    dni INT UNIQUE,
    nombre VARCHAR(255),
    apellido VARCHAR(255),
    email VARCHAR(255),
    contraseña VARCHAR(255),
    estado VARCHAR(255),
    esSuperUsuario BOOLEAN,
    esStaff BOOLEAN,
);

CREATE TABLE medico (
    id INT AUTO_INCREMENT PRIMARY KEY,
	id_user INT,
    matricula VARCHAR(255),
    especialidad VARCHAR(255),
    FOREIGN KEY (id_user) REFERENCES usuario(id)
);

CREATE TABLE administrativo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT,
    FOREIGN KEY (id_user) REFERENCES usuario(id)
);

CREATE TABLE paciente (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT,
    FOREIGN KEY (id_user) REFERENCES usuario(id)
);

INSERT INTO usuario (dni, nombre, apellido, email, contraseña, estado, esSuperUsuario, esStaff) 
    VALUES (44595596, "FOLCO", "CARRIL", "folco.carril@gmail.com", "$2a$12$T.WpBqM64hxGxJKdOM/8KOIz07uIXxIwsez1.6MOwu3Pm0a1ia9uC", "ALTA", TRUE, TRUE);
    