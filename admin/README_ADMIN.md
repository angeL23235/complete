# 📊 Panel de Administración - Traslapp

## 🎯 ¿Qué es?

El panel de administración te permite ver y gestionar todos los usuarios registrados en la base de datos directamente desde el navegador, sin necesidad de herramientas externas como phpMyAdmin o MySQL Workbench.

## 🔐 Acceso

1. **Inicia sesión** con un usuario que tenga rol de **Administrador (rol 1)** o **Super Admin (rol 3)**
2. Si tu usuario tiene rol 1 o 3, serás redirigido automáticamente a `admin/admin.php` después del login
3. O accede directamente a: `https://tu-dominio.onrender.com/admin/admin.php`

## ✨ Funcionalidades

### 1. **Ver Estadísticas**
- Total de usuarios registrados
- Cantidad de usuarios por rol (Administrador, Usuario/Proveedor, Super Admin)

### 2. **Buscar Usuarios**
- Busca por número de documento
- Busca por nombre
- Busca por apellido
- Busca por email

### 3. **Ver Lista Completa de Usuarios**
La tabla muestra:
- **ID**: Identificador único en la base de datos
- **Documento**: Número de documento del usuario
- **Nombres**: Nombre del usuario
- **Apellidos**: Apellidos del usuario
- **Email**: Correo electrónico
- **Rol**: Rol actual del usuario (con colores)
  - 🔴 **Administrador** (rol 1)
  - 🔵 **Usuario/Proveedor** (rol 2)
  - 🟣 **Super Admin** (rol 3)
- **Fecha Registro**: Cuándo se registró el usuario
- **Acciones**: Botones para gestionar el usuario

### 4. **Cambiar Rol de Usuario**
1. Click en el botón **"Cambiar Rol"** del usuario
2. Selecciona el nuevo rol
3. Confirma el cambio

### 5. **Eliminar Usuario**
1. Click en el botón **"Eliminar"** del usuario
2. Confirma la eliminación
3. ⚠️ **Advertencia**: Esto también eliminará todos los servicios asociados al usuario

## 🔍 Roles Disponibles

- **Rol 1 - Administrador**: Acceso completo al panel de administración
- **Rol 2 - Usuario/Proveedor**: Usuario normal, puede crear servicios
- **Rol 3 - Super Admin**: Acceso completo (similar a Administrador)

## 💡 Consejos

1. **Para crear un usuario administrador desde la base de datos:**
   ```sql
   UPDATE usuario SET id_rol = 1 WHERE numero_documento = 'TU_DOCUMENTO';
   ```

2. **Para ver todos los usuarios con un rol específico:**
   - Usa el filtro de búsqueda o revisa las estadísticas en la parte superior

3. **Para ver información detallada de un usuario:**
   - La tabla muestra toda la información principal
   - Puedes cambiar el rol para ver cómo se actualiza

## 🛠️ Compatibilidad

- ✅ Funciona con **PostgreSQL** (Render.com)
- ✅ Funciona con **MySQL** (desarrollo local)
- ✅ Compatible con PDO y mysqli

## 📝 Notas

- Solo usuarios con rol 1 o 3 pueden acceder a este panel
- Los cambios se reflejan inmediatamente en la base de datos
- La eliminación de usuarios es permanente
