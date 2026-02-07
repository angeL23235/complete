-- ============================================
-- Script SQL para Traslapp (PostgreSQL)
-- Base de datos completa con todas las tablas
-- Convertido de MySQL a PostgreSQL
-- ============================================

-- NOTA: La base de datos 'traslapp_db' ya debe existir en Render
-- Conéctate directamente a esa base de datos antes de ejecutar este script

-- ============================================
-- OPCIONAL: Limpiar tablas existentes (descomenta si necesitas empezar de cero)
-- ============================================
DROP TABLE IF EXISTS reserva_hoteles CASCADE;
DROP TABLE IF EXISTS calificacion CASCADE;
DROP TABLE IF EXISTS serviciosc CASCADE;
DROP TABLE IF EXISTS hotel CASCADE;
DROP TABLE IF EXISTS usuario CASCADE;

-- ============================================
-- Tabla: usuario
-- ============================================
CREATE TABLE IF NOT EXISTS usuario (
    id SERIAL PRIMARY KEY,
    tipo_documento VARCHAR(50) NOT NULL,
    numero_documento VARCHAR(50) UNIQUE NOT NULL,
    nombres VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    id_rol SMALLINT DEFAULT 2, -- 1=admin, 2=proveedor/usuario, 3=superadmin
    clave VARCHAR(255) NOT NULL,
    foto_perfil VARCHAR(255) DEFAULT NULL,
    descripcion TEXT DEFAULT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Índices para usuario
CREATE INDEX IF NOT EXISTS idx_numero_documento ON usuario(numero_documento);
CREATE INDEX IF NOT EXISTS idx_email ON usuario(email);
CREATE INDEX IF NOT EXISTS idx_rol ON usuario(id_rol);

-- Comentarios para usuario
COMMENT ON COLUMN usuario.id_rol IS '1=admin, 2=proveedor/usuario, 3=superadmin';

-- ============================================
-- Tabla: serviciosc (servicios)
-- ============================================
CREATE TABLE IF NOT EXISTS serviciosc (
    id_servicio SERIAL PRIMARY KEY,
    nombre_vendedor VARCHAR(150) NOT NULL,
    tipo_servs VARCHAR(100) NOT NULL, -- cocina, aseo, alquiler_au, etc.
    descripcion_servicio TEXT NOT NULL,
    precio_servicio DECIMAL(10,2) NOT NULL,
    fk_user VARCHAR(50) NOT NULL, -- numero_documento del usuario
    ft_servs VARCHAR(255) DEFAULT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_serviciosc_usuario FOREIGN KEY (fk_user) REFERENCES usuario(numero_documento) ON DELETE CASCADE
);

-- Índices para serviciosc
CREATE INDEX IF NOT EXISTS idx_fk_user ON serviciosc(fk_user);
CREATE INDEX IF NOT EXISTS idx_tipo_servs ON serviciosc(tipo_servs);

-- Comentarios para serviciosc
COMMENT ON COLUMN serviciosc.tipo_servs IS 'cocina, aseo, alquiler_au, etc.';
COMMENT ON COLUMN serviciosc.fk_user IS 'numero_documento del usuario';

-- ============================================
-- Tabla: calificacion
-- ============================================
CREATE TABLE IF NOT EXISTS calificacion (
    id SERIAL PRIMARY KEY,
    fk_user VARCHAR(50) NOT NULL, -- numero_documento del usuario calificado
    nombre_clien VARCHAR(150) NOT NULL,
    correo_clien VARCHAR(150) NOT NULL,
    num_estrellas SMALLINT NOT NULL CHECK (num_estrellas >= 1 AND num_estrellas <= 5),
    comentarios TEXT DEFAULT NULL,
    fecha_calificacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_calificacion_usuario FOREIGN KEY (fk_user) REFERENCES usuario(numero_documento) ON DELETE CASCADE
);

-- Índices para calificacion
CREATE INDEX IF NOT EXISTS idx_fk_user_calificacion ON calificacion(fk_user);

-- Comentarios para calificacion
COMMENT ON COLUMN calificacion.fk_user IS 'numero_documento del usuario calificado';

-- ============================================
-- Tabla: hotel
-- ============================================
CREATE TABLE IF NOT EXISTS hotel (
    id_ho SERIAL PRIMARY KEY,
    nombre_hotel VARCHAR(200) NOT NULL,
    direccion VARCHAR(255) DEFAULT NULL,
    precio_base DECIMAL(10,2) DEFAULT NULL,
    descripcion TEXT DEFAULT NULL,
    imagen VARCHAR(255) DEFAULT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ============================================
-- Tabla: reserva_hoteles
-- ============================================
CREATE TABLE IF NOT EXISTS reserva_hoteles (
    id_hotel SERIAL PRIMARY KEY,
    nombre_hotel VARCHAR(200) NOT NULL,
    valor_reserva DECIMAL(10,2) NOT NULL,
    tipo_habitacion VARCHAR(100) DEFAULT NULL,
    fecha_reserva DATE NOT NULL,
    fk_usuario_ VARCHAR(50) NOT NULL, -- numero_documento del usuario
    fk_hotel INT DEFAULT NULL, -- Referencia a hotel.id_ho
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_reserva_usuario FOREIGN KEY (fk_usuario_) REFERENCES usuario(numero_documento) ON DELETE CASCADE,
    CONSTRAINT fk_reserva_hotel FOREIGN KEY (fk_hotel) REFERENCES hotel(id_ho) ON DELETE SET NULL
);

-- Índices para reserva_hoteles
CREATE INDEX IF NOT EXISTS idx_fk_usuario ON reserva_hoteles(fk_usuario_);
CREATE INDEX IF NOT EXISTS idx_fk_hotel ON reserva_hoteles(fk_hotel);

-- Comentarios para reserva_hoteles
COMMENT ON COLUMN reserva_hoteles.fk_usuario_ IS 'numero_documento del usuario';
COMMENT ON COLUMN reserva_hoteles.fk_hotel IS 'Referencia a hotel.id_ho';

-- ============================================
-- Datos iniciales
-- ============================================

-- Insertar usuario administrador por defecto
-- Contraseña: admin123 (MD5: 0192023a7bbd73250516f069df18b500)
INSERT INTO usuario (tipo_documento, numero_documento, nombres, apellidos, email, id_rol, clave, foto_perfil)
VALUES ('CC', '00000001', 'Admin', 'Sistema', 'admin@traslapp.com', 1, MD5('admin123'), 'imagen-user/admin.png')
ON CONFLICT (numero_documento) DO NOTHING;

-- Insertar hoteles de ejemplo
INSERT INTO hotel (id_ho, nombre_hotel, direccion, precio_base, imagen) VALUES
(123, 'Ibis Budget Itagui', 'Calle 50 # 40 -17, 55413 Medellín, Colombia', 160000.00, 'img/hotel4.webp'),
(124, 'NH Collection Medellín Royal', 'Carrera 42 No 5 Sur 130, Medellín, Colombia', 437000.00, 'img/hny.jpg'),
(125, 'Medellín Marriott Hotel', 'Calle 1a Sur n.º 43a-83, Medellín, Colombia', 1482000.00, 'img/mmh.webp'),
(126, 'Four Points by Sheraton Medellin', 'Carrera 43 C #6 Sur 100, Medellín, Colombia', 360000.00, 'img/fp.jpg')
ON CONFLICT (id_ho) DO NOTHING;

-- ============================================
-- Fin del script
-- ============================================
