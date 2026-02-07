# 🚀 Guía de Despliegue - Traslapp en Render.com

Esta guía te ayudará a desplegar Traslapp en Render.com de forma gratuita, sin necesidad de XAMPP.

---

## 📋 Requisitos Previos

1. **Cuenta en Render.com**: Regístrate gratis en [render.com](https://render.com)
2. **Repositorio Git**: Tu código debe estar en GitHub, GitLab o Bitbucket
3. **Archivo `conexion.php`**: Crea este archivo basándote en `conexion.php.example`

---

## 🔧 Paso 1: Preparar el Proyecto Localmente

### 1.1 Crear el archivo de conexión

1. Copia `conexion.php.example` y renómbralo a `conexion.php`:
   ```bash
   # En Windows PowerShell
   Copy-Item conexion.php.example conexion.php
   ```

2. Edita `conexion.php` y configura los valores por defecto (solo para pruebas locales):
   ```php
   $host = '127.0.0.1';
   $user = 'root';
   $pass = '';
   $db   = 'traslapp_db';
   ```

   **⚠️ IMPORTANTE**: Este archivo NO debe subirse a Git (ya está en `.gitignore`). En Render usaremos variables de entorno.

### 1.2 Verificar permisos de carpetas

Asegúrate de que las carpetas para subir archivos existan y tengan permisos de escritura:
- `imagen-user/`
- `img-servs/`

---

## 🌐 Paso 2: Subir el Código a Git

1. Inicializa Git (si no lo has hecho):
   ```bash
   git init
   git add .
   git commit -m "Preparación para despliegue en Render"
   ```

2. Crea un repositorio en GitHub/GitLab y súbelo:
   ```bash
   git remote add origin https://github.com/tu-usuario/traslapp.git
   git push -u origin main
   ```

---

## 🎯 Paso 3: Desplegar en Render.com

### 3.1 Crear la Base de Datos MySQL

1. Ve a tu dashboard en [render.com](https://dashboard.render.com)
2. Click en **"New +"** → **"PostgreSQL"** o **"MySQL"**
   - **Nota**: Si MySQL no está disponible en el plan gratuito, usa PostgreSQL y ajusta el código (o usa el plan de pago)
   - **Alternativa gratuita**: Usa [PlanetScale](https://planetscale.com) o [Railway.app](https://railway.app) para MySQL gratis
3. Configura:
   - **Name**: `traslapp-db`
   - **Database**: `traslapp_db`
   - **User**: `traslapp_user`
   - **Plan**: Free (si está disponible)
4. Anota las credenciales que Render te proporciona:
   - `Internal Database URL` o los datos individuales (host, user, password, port)

### 3.2 Crear el Servicio Web (PHP)

1. En Render, click en **"New +"** → **"Web Service"**
2. Conecta tu repositorio de Git
3. Configura:
   - **Name**: `traslapp-web`
   - **Environment**: `PHP`
   - **Build Command**: (dejar vacío)
   - **Start Command**: `php -S 0.0.0.0:$PORT -t .`
   - **Plan**: Free

### 3.3 Configurar Variables de Entorno

En la sección **"Environment"** del servicio web, agrega estas variables:

```
DB_HOST = [el host de tu base de datos]
DB_USER = [el usuario de tu base de datos]
DB_PASSWORD = [la contraseña de tu base de datos]
DB_NAME = traslapp_db
DB_PORT = 3306
```

**Ejemplo** (ajusta según tus credenciales):
```
DB_HOST = dpg-xxxxx-a.oregon-postgres.render.com
DB_USER = traslapp_user
DB_PASSWORD = abc123xyz
DB_NAME = traslapp_db
DB_PORT = 3306
```

### 3.4 Importar la Base de Datos

1. **Opción A - Desde Render Dashboard**:
   - Ve a tu base de datos en Render
   - Click en "Connect" o "Info"
   - Usa las credenciales para conectarte con un cliente MySQL (como MySQL Workbench o DBeaver)

2. **Opción B - Desde línea de comandos**:
   ```bash
   # Descarga el archivo database.sql
   # Luego ejecuta:
   mysql -h [DB_HOST] -u [DB_USER] -p[DB_PASSWORD] [DB_NAME] < database.sql
   ```

3. **Opción C - Desde phpMyAdmin (si Render lo ofrece)**:
   - Accede al panel de administración de la BD
   - Importa el archivo `database.sql`

---

## ✅ Paso 4: Verificar el Despliegue

1. Render te dará una URL como: `https://traslapp-web.onrender.com`
2. Accede a: `https://traslapp-web.onrender.com/index.php`
3. Prueba el login con:
   - **Documento**: `00000001`
   - **Contraseña**: `admin123`

---

## 🔄 Paso 5: Configurar Carpetas Persistentes (Opcional)

Render no persiste archivos subidos por defecto. Para solucionarlo:

### Opción A: Usar un servicio de almacenamiento (Recomendado)
- **Cloudinary** (gratis): Para imágenes
- **AWS S3**: Para archivos
- **Render Disk**: Plan de pago

### Opción B: Usar variables de entorno para rutas
Modifica el código para guardar imágenes en un servicio externo.

---

## 🛠️ Solución de Problemas

### Error: "No se puede conectar a la base de datos"
- Verifica que las variables de entorno estén correctamente configuradas
- Asegúrate de que la BD esté activa (en plan gratuito puede pausarse)
- Verifica que el host sea accesible desde el servicio web

### Error: "Permission denied" al subir archivos
- Verifica permisos de las carpetas `imagen-user/` y `img-servs/`
- Considera usar un servicio de almacenamiento externo

### La aplicación se pausa después de inactividad
- En el plan gratuito, Render pausa los servicios después de 15 minutos de inactividad
- La primera petición después de pausarse puede tardar ~30 segundos
- Para evitar esto, considera usar un servicio de "ping" automático o actualizar a un plan de pago

---

## 📝 Notas Importantes

1. **Plan Gratuito de Render**:
   - Los servicios se pausan después de 15 minutos de inactividad
   - La base de datos puede tener límites de tamaño
   - El servicio web puede tener límites de CPU/RAM

2. **Alternativas Gratuitas**:
   - **Railway.app**: Similar a Render, con MySQL gratis
   - **PlanetScale**: Base de datos MySQL serverless gratis
   - **000webhost**: Hosting PHP/MySQL gratis (con limitaciones)

3. **Seguridad**:
   - Nunca subas `conexion.php` con credenciales hardcodeadas a Git
   - Usa siempre variables de entorno en producción
   - Considera usar `password_hash()` en lugar de MD5 para contraseñas

---

## 🎉 ¡Listo!

Tu aplicación debería estar funcionando en línea. Si tienes problemas, revisa los logs en el dashboard de Render.

---

## 📞 Soporte

- Documentación de Render: https://render.com/docs
- Foro de Render: https://community.render.com
