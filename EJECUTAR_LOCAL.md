# 🚀 Cómo Ejecutar Traslapp Localmente

## Opción 1: Con XAMPP (Más Fácil) ⚡

### Paso 1: Iniciar MySQL en XAMPP
1. Abre **XAMPP Control Panel**
2. Inicia **MySQL** (click en "Start")
3. **NO necesitas Apache** para esto, solo MySQL

### Paso 2: Crear la Base de Datos
1. Abre tu navegador y ve a: `http://localhost/phpmyadmin`
2. Click en **"Nueva"** (New) en el menú lateral
3. Nombre de la base de datos: `traslapp_db`
4. Cotejamiento: `utf8mb4_unicode_ci`
5. Click en **"Crear"**

### Paso 3: Importar las Tablas
1. Selecciona la base de datos `traslapp_db`
2. Click en la pestaña **"Importar"** (Import)
3. Click en **"Seleccionar archivo"** y elige `database.sql`
4. Click en **"Continuar"** (Go)

### Paso 4: Crear el archivo de conexión
1. Copia `conexion.php.example` y renómbralo a `conexion.php`
2. Edita `conexion.php` y verifica que tenga estos valores:
   ```php
   $host = '127.0.0.1';
   $user = 'root';
   $pass = '';  // XAMPP por defecto no tiene contraseña
   $db   = 'traslapp_db';
   $port = '3306';
   ```

### Paso 5: Ejecutar el Servidor PHP
Abre PowerShell en la carpeta `complete` y ejecuta:

```powershell
cd D:\Traslapp\complete
php -S localhost:8000
```

### Paso 6: Abrir en el Navegador
Abre tu navegador y ve a:
```
http://localhost:8000/index.php
```

### Login de Prueba:
- **Documento**: `00000001`
- **Contraseña**: `admin123`

---

## Opción 2: Sin XAMPP (Solo MySQL Standalone) 🔧

### Paso 1: Instalar MySQL
Descarga e instala MySQL desde: https://dev.mysql.com/downloads/mysql/

### Paso 2: Crear Base de Datos
Abre MySQL Command Line Client o MySQL Workbench y ejecuta:

```sql
CREATE DATABASE traslapp_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Luego importa el archivo `database.sql`:
```bash
mysql -u root -p traslapp_db < database.sql
```

### Paso 3: Configurar conexion.php
Edita `conexion.php` con tus credenciales de MySQL:
```php
$host = '127.0.0.1';
$user = 'root';
$pass = 'tu_contraseña_mysql';  // La que configuraste al instalar
$db   = 'traslapp_db';
$port = '3306';
```

### Paso 4: Ejecutar Servidor PHP
```powershell
cd D:\Traslapp\complete
php -S localhost:8000
```

### Paso 5: Abrir en el Navegador
```
http://localhost:8000/index.php
```

---

## Opción 3: Con Docker (Avanzado) 🐳

Si tienes Docker instalado:

```bash
# Crear docker-compose.yml (ver abajo)
docker-compose up -d
```

Luego ejecuta PHP como en las opciones anteriores.

---

## ⚠️ Solución de Problemas

### Error: "php no se reconoce como comando"
- Instala PHP desde: https://windows.php.net/download/
- O usa XAMPP y ejecuta desde: `C:\xampp\php\php.exe -S localhost:8000`

### Error: "No se puede conectar a la base de datos"
- Verifica que MySQL esté corriendo
- Revisa las credenciales en `conexion.php`
- Asegúrate de que la base de datos `traslapp_db` exista

### Error: "Access denied for user"
- Verifica usuario y contraseña en `conexion.php`
- En XAMPP, el usuario por defecto es `root` sin contraseña

---

## 📝 Notas

- El servidor PHP embebido (`php -S`) es solo para desarrollo
- Para producción, usa Apache/Nginx o despliega en Render.com
- Las imágenes se guardan en `imagen-user/` y `img-servs/`

---

¡Listo para probar! 🎉
