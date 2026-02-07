-- ============================================
-- Script SQL para Traslapp
-- Base de datos completa con todas las tablas
-- ============================================

-- Crear base de datos
CREATE DATABASE IF NOT EXISTS traslapp_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE traslapp_db;

-- ============================================
-- Tabla: usuario
-- ============================================
CREATE TABLE IF NOT EXISTS usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo_documento VARCHAR(50) NOT NULL,
    numero_documento VARCHAR(50) UNIQUE NOT NULL,
    nombres VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    id_rol TINYINT DEFAULT 2 COMMENT '1=admin, 2=proveedor/usuario, 3=superadmin',
    clave VARCHAR(255) NOT NULL,
    foto_perfil VARCHAR(255) DEFAULT NULL,
    descripcion TEXT DEFAULT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_numero_documento (numero_documento),
    INDEX idx_email (email),
    INDEX idx_rol (id_rol)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- Tabla: serviciosc (servicios)
-- ============================================
CREATE TABLE IF NOT EXISTS serviciosc (
    id_servicio INT AUTO_INCREMENT PRIMARY KEY,
    nombre_vendedor VARCHAR(150) NOT NULL,
    tipo_servs VARCHAR(100) NOT NULL COMMENT 'cocina, aseo, alquiler_au, etc.',
    descripcion_servicio TEXT NOT NULL,
    precio_servicio DECIMAL(10,2) NOT NULL,
    fk_user VARCHAR(50) NOT NULL COMMENT 'numero_documento del usuario',
    ft_servs VARCHAR(255) DEFAULT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_fk_user (fk_user),
    INDEX idx_tipo_servs (tipo_servs),
    FOREIGN KEY (fk_user) REFERENCES usuario(numero_documento) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- Tabla: calificacion
-- ============================================
CREATE TABLE IF NOT EXISTS calificacion (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fk_user VARCHAR(50) NOT NULL COMMENT 'numero_documento del usuario calificado',
    nombre_clien VARCHAR(150) NOT NULL,
    correo_clien VARCHAR(150) NOT NULL,
    num_estrellas TINYINT NOT NULL CHECK (num_estrellas >= 1 AND num_estrellas <= 5),
    comentarios TEXT DEFAULT NULL,
    fecha_calificacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_fk_user (fk_user),
    FOREIGN KEY (fk_user) REFERENCES usuario(numero_documento) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- Tabla: hotel
-- ============================================
CREATE TABLE IF NOT EXISTS hotel (
    id_ho INT AUTO_INCREMENT PRIMARY KEY,
    nombre_hotel VARCHAR(200) NOT NULL,
    direccion VARCHAR(255) DEFAULT NULL,
    precio_base DECIMAL(10,2) DEFAULT NULL,
    descripcion TEXT DEFAULT NULL,
    imagen VARCHAR(255) DEFAULT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- Tabla: reserva_hoteles
-- ============================================
CREATE TABLE IF NOT EXISTS reserva_hoteles (
    id_hotel INT AUTO_INCREMENT PRIMARY KEY,
    nombre_hotel VARCHAR(200) NOT NULL,
    valor_reserva DECIMAL(10,2) NOT NULL,
    tipo_habitacion VARCHAR(100) DEFAULT NULL,
    fecha_reserva DATE NOT NULL,
    fk_usuario_ VARCHAR(50) NOT NULL COMMENT 'numero_documento del usuario',
    fk_hotel INT DEFAULT NULL COMMENT 'Referencia a hotel.id_ho',
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_fk_usuario (fk_usuario_),
    INDEX idx_fk_hotel (fk_hotel),
    FOREIGN KEY (fk_usuario_) REFERENCES usuario(numero_documento) ON DELETE CASCADE,
    FOREIGN KEY (fk_hotel) REFERENCES hotel(id_ho) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- Datos iniciales
-- ============================================

-- Insertar usuario administrador por defecto
-- Contraseña: admin123 (MD5: 0192023a7bbd73250516f069df18b500)
INSERT INTO usuario (tipo_documento, numero_documento, nombres, apellidos, email, id_rol, clave, foto_perfil)
VALUES ('CC', '00000001', 'Admin', 'Sistema', 'admin@traslapp.com', 1, MD5('admin123'), 'imagen-user/admin.png')
ON DUPLICATE KEY UPDATE numero_documento=numero_documento;

-- Insertar hoteles de ejemplo
INSERT INTO hotel (id_ho, nombre_hotel, direccion, precio_base, imagen) VALUES
(123, 'Ibis Budget Itagui', 'Calle 50 # 40 -17, 55413 Medellín, Colombia', 160000.00, 'img/hotel4.webp'),
(124, 'NH Collection Medellín Royal', 'Carrera 42 No 5 Sur 130, Medellín, Colombia', 437000.00, 'img/hny.jpg'),
(125, 'Medellín Marriott Hotel', 'Calle 1a Sur n.º 43a-83, Medellín, Colombia', 1482000.00, 'img/mmh.webp'),
(126, 'Four Points by Sheraton Medellin', 'Carrera 43 C #6 Sur 100, Medellín, Colombia', 360000.00, 'img/fp.jpg')
ON DUPLICATE KEY UPDATE nombre_hotel=nombre_hotel;

-- ============================================
-- Fin del script
-- ============================================
