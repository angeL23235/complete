# Traslapp

Aplicación web desarrollada en PHP para gestionar usuarios y servicios. Incluye panel de usuario, gestión de servicios y sistema de calificaciones.

## Tecnologías

- PHP 7.4+
- MySQL/MariaDB
- HTML/CSS
- JavaScript

## Características

- Registro e inicio de sesión de usuarios
- Panel de control para clientes
- Gestión de servicios (hostelería, cocina, transporte, limpieza)
- Sistema de calificaciones y comentarios
- Soporte para múltiples idiomas
- Carga de imágenes de perfil y servicios

## Requisitos

- PHP 7.4 o superior
- MySQL/MariaDB
- Servidor web (Apache o similar)
- Extensión mysqli habilitada

## Instalación

1. Clonar o descargar el proyecto:

```bash
git clone <repo>
```

2. Colocar en la carpeta raíz del servidor web (htdocs en XAMPP)

3. Crear la base de datos:

```bash
mysql -u root < database.sql
```

4. Configurar conexión en `conexion.php`

5. Acceder en el navegador:

```
http://localhost/complete/
```

## Estructura del Proyecto

```
complete/
├── index.php              # Página de login
├── register.php           # Página de registro
├── client/                # Panel de usuario
├── modules/               # Módulos de servicios
├── css/                   # Estilos
├── img/                   # Imágenes del proyecto
├── imagen-user/           # Fotos de perfil (subidas)
└── img-servs/             # Imágenes de servicios (subidas)
```

## Notas de Seguridad

- La conexión a base de datos debe estar en `conexion.php` (no incluida por seguridad)
- Se recomienda usar password_hash en lugar de MD5 para contraseñas
- Validar y escapar todos los inputs en formularios
- Configurar permisos adecuados en carpetas de upload
