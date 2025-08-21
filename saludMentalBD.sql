-- Base de datos
CREATE DATABASE IF NOT EXISTS salud_mental;
USE salud_mental;

-- Tabla de usuarios (pacientes y psicólogos)
CREATE TABLE IF NOT EXISTS usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) UNIQUE NOT NULL,
    contrasena VARCHAR(255) NOT NULL, -- encriptada
    rol ENUM('Usuario','Psicologo') NOT NULL,
    fotoperfil VARCHAR(255) DEFAULT 'default.png'
);

-- Tabla: psicologos_especialidades
CREATE TABLE IF NOT EXISTS psicologos_especialidades (
    id_especialidad INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    descripcion TEXT
);

-- Tabla intermedia: usuario_especialidad (usuarios tipo profesional)
CREATE TABLE IF NOT EXISTS usuario_especialidad (
    id_usuario INT,
    id_especialidad INT,
    PRIMARY KEY (id_usuario, id_especialidad),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE,
    FOREIGN KEY (id_especialidad) REFERENCES psicologos_especialidades(id_especialidad) ON DELETE CASCADE
);

-- Tabla: autoevaluaciones
CREATE TABLE IF NOT EXISTS autoevaluaciones (
    id_autoevaluacion INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    estado_emocional VARCHAR(100),
    puntaje INT,
    recomendacion TEXT,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE
);

-- Tabla: tecnicas
CREATE TABLE IF NOT EXISTS tecnicas (
    id_tecnica INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100),
    descripcion TEXT,
    tipo ENUM('audio', 'video', 'texto'),
    url_recurso TEXT
);

-- Tabla: tecnicas_aplicadas (relación usuarios ↔ técnicas)
CREATE TABLE IF NOT EXISTS tecnicas_aplicadas (
    id_tecnica_aplicada INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    id_tecnica INT,
    fecha_aplicacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE,
    FOREIGN KEY (id_tecnica) REFERENCES tecnicas(id_tecnica) ON DELETE CASCADE
);

-- Tabla: reportes_emocionales
CREATE TABLE IF NOT EXISTS reportes_emocionales (
    id_reporte INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    fecha_generado DATETIME DEFAULT CURRENT_TIMESTAMP,
    contenido TEXT,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE
);

-- Tabla: sesiones_chat
CREATE TABLE IF NOT EXISTS sesiones_chat (
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
CREATE TABLE IF NOT EXISTS mensajes_chat (
    id_mensaje INT AUTO_INCREMENT PRIMARY KEY,
    id_chat INT,
    id_emisor INT,
    contenido TEXT,
    fecha_envio DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_chat) REFERENCES sesiones_chat(id_chat) ON DELETE CASCADE,
    FOREIGN KEY (id_emisor) REFERENCES usuarios(id_usuario) ON DELETE CASCADE
);

-- Tabla de evaluaciones emocionales
CREATE TABLE IF NOT EXISTS evaluaciones (
    id_evaluacion INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    estado_emocional VARCHAR(50) NOT NULL,
    notas TEXT,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);

-- Relación entre pacientes y psicólogos
CREATE TABLE IF NOT EXISTS pacientes_psicologo (
    id_paciente INT NOT NULL,
    id_psicologo INT NOT NULL,
    PRIMARY KEY (id_paciente, id_psicologo),
    FOREIGN KEY (id_paciente) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_psicologo) REFERENCES usuarios(id_usuario)
);

-- Tabla de citas
CREATE TABLE IF NOT EXISTS citas (
    id_cita INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_psicologo INT NOT NULL,
    fechahora DATETIME NOT NULL,
    estado ENUM('Pendiente','Confirmada','Cancelada','Completada') DEFAULT 'Pendiente',
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_psicologo) REFERENCES usuarios(id_usuario)
);

-- Usuarios (2 pacientes, 1 psicólogo)
INSERT INTO usuarios (nombre, correo, contrasena, rol, fotoperfil) VALUES
('Ana López', 'ana@correo.com', '$2y$10$abcdefghijklmnopqrstuv', 'Usuario', 'ana.png'),
('Carlos Ruiz', 'carlos@correo.com', '$2y$10$abcdefghijklmnopqrstuv', 'Usuario', 'carlos.png'),
('Dra. Sofia Mendez', 'sofia@psico.com', '$2y$10$abcdefghijklmnopqrstuv', 'Psicologo', 'sofia.png');
INSERT INTO `usuarios` (`id_usuario`, `nombre`, `correo`, `contrasena`, `rol`, `fotoperfil`) VALUES (NULL, 'FEEEEEEEER', 'prueba1@correofalso.com', '$2y$10$tPrSNy5iLON/DZt9dg.yH.b.6SYx3lFZRa89mys0mzUugT2hiw9ue', 'Usuario', 'default.png'), (NULL, 'FER el PSICOLOGO', 'psicoprueba1@fakemail.com', '$2y$10$U6EZ3lnndiLScBWSmAjb/.PXLPaB5Z4dk9WqlETl4uKR1yGy.Oj1e', 'Psicologo', 'default.png')
-- Especialidades de psicólogos
INSERT INTO psicologos_especialidades (nombre, descripcion) VALUES
('Ansiedad', 'Tratamiento de trastornos de ansiedad'),
('Depresion', 'Especialista en depresion'),
('Adolescentes', 'Atencion a adolescentes');

-- Relación usuario-especialidad (psicólogo)
INSERT INTO usuario_especialidad (id_usuario, id_especialidad) VALUES
(3, 1), (3, 2), (3, 3);

-- Relación pacientes-psicólogo
INSERT INTO pacientes_psicologo (id_paciente, id_psicologo) VALUES
(1, 3), (2, 3);

-- Técnicas
INSERT INTO tecnicas (titulo, descripcion, tipo, url_recurso) VALUES
('Respiracion profunda', 'Ejercicio de respiracion para reducir ansiedad', 'audio', 'audio1.mp3'),
('Diario emocional', 'Escribe tus emociones diariamente', 'texto', 'diario.pdf'),
('Relajacion muscular', 'Relajacion progresiva guiada', 'video', 'relajacion.mp4');

-- Técnicas aplicadas
INSERT INTO tecnicas_aplicadas (id_usuario, id_tecnica) VALUES
(1, 1), (1, 2), (2, 3);

-- Autoevaluaciones
INSERT INTO autoevaluaciones (id_usuario, fecha, estado_emocional, puntaje, recomendacion) VALUES
(1, '2025-08-01 10:00:00', 'Triste', 3, 'Habla con alguien de confianza.'),
(1, '2025-08-05 14:00:00', 'Ansioso', 5, 'Practica respiracion profunda.'),
(2, '2025-08-03 09:00:00', 'Feliz', 8, 'Sigue con tus habitos positivos.');

-- Evaluaciones emocionales
INSERT INTO evaluaciones (id_usuario, fecha, estado_emocional, notas) VALUES
(1, '2025-08-01 10:00:00', 'Triste', 'Me senti cansada.'),
(1, '2025-08-05 14:00:00', 'Ansioso', 'Preocupacion por examenes.'),
(2, '2025-08-03 09:00:00', 'Feliz', 'Buen dia en familia.');

-- Reportes emocionales
INSERT INTO reportes_emocionales (id_usuario, fecha_generado, contenido) VALUES
(1, '2025-08-06 12:00:00', 'Reporte semanal de Ana'),
(2, '2025-08-06 12:00:00', 'Reporte semanal de Carlos'),
(1, '2025-08-13 12:00:00', 'Reporte semanal de Ana (2)');

-- Sesiones de chat
INSERT INTO sesiones_chat (id_usuario_joven, id_usuario_pro, fecha_inicio, tipo_sesion) VALUES
(1, 3, '2025-08-01 15:00:00', 'texto'),
(2, 3, '2025-08-02 16:00:00', 'videollamada'),
(1, 3, '2025-08-03 17:00:00', 'texto');

-- Mensajes de chat
INSERT INTO mensajes_chat (id_chat, id_emisor, contenido) VALUES
(1, 1, 'Hola, necesito ayuda.'),
(1, 3, 'Hola Ana, ¿como te sientes hoy?'),
(2, 2, 'Buenas tardes, doctora.');

-- Citas
INSERT INTO citas (id_usuario, id_psicologo, fechahora, estado) VALUES
(1, 3, '2025-08-10 09:00:00', 'Pendiente'),
(2, 3, '2025-08-11 10:00:00', 'Confirmada'),
(1, 3, '2025-08-12 11:00:00', 'Completada');
