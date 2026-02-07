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
   - **User**: `  `
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

**Paso 1: Obtener las credenciales de conexión**

1. Ve a tu dashboard en Render.com
2. Click en tu base de datos (ej: `traslapp-db`)
3. En la sección **"Connections"** o **"Info"**, encontrarás:
   - **Internal Database URL**: Una URL completa tipo `mysql://user:password@host:port/database`
   - O los datos individuales: Host, User, Password, Port, Database

**Paso 2: Elegir método de importación**

#### **Opción A - Usando MySQL Workbench (Recomendado - Más fácil)**

1. **Descargar MySQL Workbench** (si no lo tienes):
   - Ve a: https://dev.mysql.com/downloads/workbench/
   - Descarga e instala la versión para Windows

2. **Conectar a la base de datos de Render**:
   - Abre MySQL Workbench
   - Click en el botón **"+"** para crear nueva conexión
   - Configura:
     - **Connection Name**: `Render - Traslapp`
     - **Hostname**: [El host de Render, ej: `dpg-xxxxx-a.oregon-postgres.render.com`]
     - **Port**: [El puerto, generalmente `3306`]
     - **Username**: [Tu usuario de Render]
     - **Password**: Click en "Store in Keychain" y pega tu contraseña
     - Click en **"Test Connection"** para verificar
     - Click en **"OK"**

3. **Importar el archivo SQL**:
   - Conecta a la base de datos haciendo doble click en la conexión
   - En el menú superior: **Server** → **Data Import**
   - Selecciona **"Import from Self-Contained File"**
   - Click en **"..."** y selecciona tu archivo `database.sql`
   - En **"Default Target Schema"**, selecciona tu base de datos (`traslapp_db`)
   - Click en **"Start Import"**
   - Espera a que termine (verás un mensaje de éxito)

#### **Opción B - Usando línea de comandos (Windows PowerShell)**

Si tienes MySQL instalado (XAMPP incluye MySQL):

1. **Abre PowerShell** y navega a la carpeta de tu proyecto:
   ```powershell
   cd C:\xampp\htdocs\complete
   ```

2. **Ejecuta el comando de importación**:
   ```powershell
   # Reemplaza los valores entre corchetes con tus credenciales reales
   & "C:\xampp\mysql\bin\mysql.exe" -h [DB_HOST] -u [DB_USER] -p[DB_PASSWORD] [DB_NAME] < database.sql
   ```

   **Ejemplo real** (ajusta con tus credenciales):
   ```powershell
   & "C:\xampp\mysql\bin\mysql.exe" -h dpg-xxxxx-a.oregon-postgres.render.com -u traslapp_user -pabc123xyz traslapp_db < database.sql
   ```

   **Nota**: Si te pide contraseña, usa este formato:
   ```powershell
   & "C:\xampp\mysql\bin\mysql.exe" -h [DB_HOST] -u [DB_USER] -p [DB_NAME] < database.sql
   ```
   (te pedirá la contraseña de forma segura)

#### **Opción C - Usando DBeaver (Alternativa gratuita)**

1. **Descargar DBeaver**: https://dbeaver.io/download/
2. **Crear nueva conexión**:
   - Click en **"New Database Connection"**
   - Selecciona **MySQL**
   - Completa los datos de conexión de Render
   - Click en **"Test Connection"** y luego **"Finish"**
3. **Importar SQL**:
   - Click derecho en tu base de datos → **SQL Editor** → **New SQL Script**
   - Abre el archivo `database.sql` y cópialo
   - Pégalo en el editor y ejecuta (F5 o botón "Execute")

**Paso 3: Verificar la importación**

Después de importar, verifica que las tablas se crearon correctamente:
- Deberías ver las tablas: `usuario`, `serviciosc`, `calificacion`, `hotel`, `reserva_hoteles`
- Debería existir un usuario admin con documento `00000001` y contraseña `admin123`

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
