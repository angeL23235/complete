# Traslapp — Aplicación de servicios ✅

**Descripción breve**

Traslapp es una aplicación web en PHP para gestionar usuarios y servicios (hostelería, cocina, transporte, limpieza, etc.). Incluye registro/login de usuarios, panel de cliente (`client/dashboard.php`), módulos de servicios (`modules/`), administración y sistema de calificaciones.

---

## 📦 Estructura principal

- `index.php`, `register.php` — Entradas públicas (login/registro)
- `client/` — Panel de usuario
- `modules/` — Módulos por categoría (cocina, autos, aseo, etc.)
- `css/`, `img/`, `img-servs/`, `imagen-user/` — Recursos estáticos
- `translation/` — Traducciones (español / inglés)
- Archivos PHP que realizan acciones: `codigoregistrar.php`, `codigocreate.php`, `codigoservs.php`, `codigoadmin.php`, etc.

---

## ⚙️ Requisitos

- PHP 7.4+ (o PHP 8.x recomendado)
- MySQL/MariaDB
- Servidor web (Apache con XAMPP/WAMP o usar el servidor embebido de PHP)
- Extensión `mysqli` habilitada
- Espacio de escritura para las carpetas `imagen-user/` y `img-servs/` (para uploads)

---

## 🔧 Instalación y ejecución (Windows)

1. Clonar o copiar el proyecto en tu entorno local:

```bash
git clone <repo> # o copiar la carpeta `complete/` a tu servidor local
```

2. Si usas XAMPP/WAMP: coloca la carpeta `complete/` en `htdocs` (o la carpeta pública correspondiente) y arranca Apache + MySQL.

3. Crear la base de datos (ejemplo):

```sql
CREATE DATABASE traslapp_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE traslapp_db;
```

4. Crear tablas mínimas (ejemplo):

```sql
-- Tabla de usuarios
CREATE TABLE usuario (
  id INT AUTO_INCREMENT PRIMARY KEY,
  tipo_documento VARCHAR(50),
  numero_documento VARCHAR(50) UNIQUE,
  nombres VARCHAR(100),
  apellidos VARCHAR(100),
  email VARCHAR(150) UNIQUE,
  id_rol TINYINT DEFAULT 2, -- 1=admin,2=proveedor/usuario
  clave VARCHAR(255),
  foto_perfil VARCHAR(255)
);

-- Tabla de servicios
CREATE TABLE serviciosc (
  id_servicio INT AUTO_INCREMENT PRIMARY KEY,
  nombre_vendedor VARCHAR(150),
  tipo_servs VARCHAR(100),
  descripcion_servicio TEXT,
  precio_servicio DECIMAL(10,2),
  fk_user VARCHAR(50), -- guarda numero_documento del usuario
  ft_servs VARCHAR(255)
);

-- Tabla de calificaciones
CREATE TABLE calificacion (
  id INT AUTO_INCREMENT PRIMARY KEY,
  fk_user VARCHAR(50),
  nombre_clien VARCHAR(150),
  correo_clien VARCHAR(150),
  num_estrellas TINYINT,
  comentarios TEXT
);
```

5. Crear el archivo de conexión `conexion.php` en la raíz del proyecto (no está incluido por seguridad). Ejemplo mínimo:

```php
<?php
$host = '127.0.0.1';
$user = 'tu_usuario';
$pass = 'tu_password';
$db   = 'traslapp_db';

$con = mysqli_connect($host, $user, $pass, $db);
if (!$con) {
    die('Error de conexión (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
}
?>
```

> Reemplaza `tu_usuario`, `tu_password` y `traslapp_db` por tus credenciales reales.

6. Asegúrate de que existan y sean escribibles las carpetas `imagen-user/` y `img-servs/` (subida de imágenes).

7. Accede desde el navegador:

- Si usas XAMPP/WAMP: `http://localhost/complete/index.php`
- O usa el servidor embebido de PHP (desde la carpeta `complete`):

```bash
php -S localhost:8000
# y abre http://localhost:8000/index.php
```

---

## ✅ Creación de un usuario admin (ejemplo)

Puedes crear un admin directamente en la BD (la aplicación usa MD5 para encriptar contraseñas en el código actual):

```sql
INSERT INTO usuario (tipo_documento, numero_documento, nombres, apellidos, email, id_rol, clave, foto_perfil)
VALUES ('CC','00000001','Admin','Admin','admin@example.com', 1, MD5('admin123'), 'imagen-user/admin.png');
```

> Nota: MD5 **no** es seguro para producción. Se recomienda usar password_hash/password_verify en futuras mejoras.

---

## 📌 Notas y recomendaciones

- `conexion.php` no está en el repositorio por seguridad; crea tu propia versión como se indica.
- Revisa `php.ini` si tienes problemas con uploads (`upload_max_filesize`, `post_max_size`).
- Las rutas en los includes usan rutas relativas; si mueves el proyecto verifica que las rutas sean correctas.
- Seguridad: realiza validación/escape de inputs y mejora el hashing de contraseñas antes de desplegar en producción.

---

Si quieres, puedo:

- Añadir un fichero `conexion.php.example` listo para copiar ✅
- Generar un script `dump.sql` con la estructura de tablas estimada ✅

Dime qué prefieres y lo preparo. 🔧
