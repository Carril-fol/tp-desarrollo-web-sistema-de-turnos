CREATE TABLE persona (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    dni BIGINT UNIQUE,
    nombre VARCHAR(255),
    apellido VARCHAR(255),
    email VARCHAR(255),
    contraseña VARCHAR(255),
    estado VARCHAR(255)
);

CREATE TABLE medico (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
	persona_id BIGINT,
    matricula VARCHAR(255),
    especialidad VARCHAR(255),
    FOREIGN KEY (persona_id) REFERENCES persona(id)
);

CREATE TABLE administrativo (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    persona_id BIGINT,
    puesto VARCHAR(255),
    FOREIGN KEY (persona_id) REFERENCES persona(id)
);

CREATE paciente (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    persona_id BIGINT,
    numero_de_obra_social BIGINT,
    es_socio BOOL,
    FOREIGN KEY (persona_id) REFERENCES persona(id)
);