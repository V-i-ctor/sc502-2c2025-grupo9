-- Base de datos
CREATE DATABASE IF NOT EXISTS salud_mental;
USE salud_mental;

-- Tabla: usuarios
CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    apellido VARCHAR(100),
    correo VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    tipo_usuario ENUM('joven', 'profesional') NOT NULL,
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Tabla: autoevaluaciones
CREATE TABLE autoevaluaciones (
    id_autoevaluacion INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    estado_emocional VARCHAR(100),
    puntaje INT,
    recomendacion TEXT,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE
);

-- Tabla: tecnicas
CREATE TABLE tecnicas (
    id_tecnica INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100),
    descripcion TEXT,
    tipo ENUM('audio', 'video', 'texto'),
    url_recurso TEXT
);

-- Tabla: tecnicas_aplicadas (relación usuarios ↔ técnicas)
CREATE TABLE tecnicas_aplicadas (
    id_tecnica_aplicada INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    id_tecnica INT,
    fecha_aplicacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE,
    FOREIGN KEY (id_tecnica) REFERENCES tecnicas(id_tecnica) ON DELETE CASCADE
);

-- Tabla: reportes_emocionales
CREATE TABLE reportes_emocionales (
    id_reporte INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    fecha_generado DATETIME DEFAULT CURRENT_TIMESTAMP,
    contenido TEXT,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE
);

-- Tabla: psicologos_especialidades
CREATE TABLE psicologos_especialidades (
    id_especialidad INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    descripcion TEXT
);

-- Tabla intermedia: usuario_especialidad (usuarios tipo profesional)
CREATE TABLE usuario_especialidad (
    id_usuario INT,
    id_especialidad INT,
    PRIMARY KEY (id_usuario, id_especialidad),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE,
    FOREIGN KEY (id_especialidad) REFERENCES psicologos_especialidades(id_especialidad) ON DELETE CASCADE
);

-- Tabla: sesiones_chat
CREATE TABLE sesiones_chat (
    id_chat INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario_joven INT,
    id_usuario_pro INT,
    fecha_inicio DATETIME DEFAULT CURRENT_TIMESTAMP,
    fecha_fin DATETIME,
    tipo_sesion ENUM('texto', 'videollamada'),
    FOREIGN KEY (id_usuario_joven) REFERENCES usuarios(id_usuario) ON DELETE CASCADE,
    FOREIGN KEY (id_usuario_pro) REFERENCES usuarios(id_usuario) ON DELETE CASCADE
);

-- Tabla: mensajes_chat
CREATE TABLE mensajes_chat (
    id_mensaje INT AUTO_INCREMENT PRIMARY KEY,
    id_chat INT,
    id_emisor INT,
    contenido TEXT,
    fecha_envio DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_chat) REFERENCES sesiones_chat(id_chat) ON DELETE CASCADE,
    FOREIGN KEY (id_emisor) REFERENCES usuarios(id_usuario) ON DELETE CASCADE
);
