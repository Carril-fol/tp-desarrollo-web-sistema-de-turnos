CREATE TABLE usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    dni INT UNIQUE,
    nombre VARCHAR(255),
    apellido VARCHAR(255),
    email VARCHAR(255),
    contraseña VARCHAR(255),
    estado VARCHAR(255)
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
    numero_de_obra_social BIGINT,
    es_socio BOOLEAN,
    FOREIGN KEY (id_user) REFERENCES usuario(id)
);