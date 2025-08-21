-- Insertar usuario de prueba
INSERT INTO usuarios (nombre, apellido, correo, password, tipo_usuario)
VALUES ('Usuario', 'Prueba', 'usuario.prueba@example.com', '123456', 'joven');

-- Insertar datos de prueba en articulos

INSERT INTO articulos (titulo, resumen, contenido, imagen_url, autor) VALUES
(
  'Ejercicios de respiración para reducir la ansiedad',
  'Técnicas simples y prácticas para controlar la ansiedad con la respiración.',
  'La técnica de respiración diafragmática —inhalar profundamente desde el abdomen y exhalar de manera controlada— puede reducir los niveles de cortisol y activar el sistema parasimpático, promoviendo calma y relajación.' ,
  'https://www.bupasalud.com/salud/ejercicios-de-respiraci%C3%B3n-para-la-ansiedad',
  'Fuente: Bupa Salud'
),
(
  '3 ejercicios de mindfulness para conectar con el presente',
  'Tres prácticas sencillas para entrenar la atención plena y reducir el estrés.',
  'El primer ejercicio consiste en observar una pasa (u otro objeto) con atención plena, notar cada detalle, luego saborearlo lentamente. Otro es respirar conscientemente por un minuto, y el tercero enfocar las actividades diarias sin distracciones como lavar los platos o caminar, prestando atención total al momento presente.' ,
  'https://psicologia-estrategica.com/3-ejercicios-mindfuldness-conectar-presente/',
  'Fuente: Psicología Estratégica'
),
(
  'Cómo influye el sueño en la salud mental',
  'Descubre cómo la calidad del sueño impacta tu bienestar emocional y cognitivo.',
  'Dormir bien mejora la concentración, la capacidad de toma de decisiones y reduce el estrés. Por el contrario, la falta de descanso se vincula con irritabilidad, ansiedad, dificultades de adaptación y peores resultados cognitivos.' ,
  'https://www.nationalgeographicla.com/ciencia/2023/02/como-influye-el-sueno-en-la-salud-mental',
  'Fuente: National Geographic'
);

-- Insertar datos de prueba en videos

INSERT INTO videos (titulo, descripcion, autor, url_video) VALUES
(
  'Ejercicio de respiración para reducir la ansiedad',
  'Video breve que enseña una técnica de respiración para calmar la mente y reducir el nivel de ansiedad.',
  'Coach Bienestar',
  'https://www.youtube.com/embed/3oCC4NDgYrY'
),
(
  'Mindfulness básico para conectar contigo',
  'Ejercicio guiado de mindfulness para reconectar con el momento presente y manejar el estrés.',
  'Coach Mindful',
  'https://www.youtube.com/embed/FU4OTllcOXM'
),
(
  'Rutina para mejorar el sueño',
  'Video con consejos y una rutina para dormir mejor y cuidar la salud mental.',
  'Psicóloga Durmiente',
  'https://www.youtube.com/embed/VIE0TJs25ZA'
);

