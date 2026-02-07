# ⚡ Inicio Rápido - Despliegue en Render.com

## 🎯 Resumen

Esta guía rápida te ayudará a desplegar Traslapp en Render.com en menos de 15 minutos.

---

## 📦 Archivos Creados

1. **`database.sql`** - Script completo de la base de datos
2. **`conexion.php.example`** - Plantilla de conexión (cópiala a `conexion.php`)
3. **`render.yaml`** - Configuración para Render.com
4. **`DEPLOY.md`** - Guía detallada de despliegue

---

## 🚀 Pasos Rápidos

### 1. Preparar conexión.php (Local)

```bash
# Copia el archivo de ejemplo
Copy-Item conexion.php.example conexion.php
```

Edita `conexion.php` con tus valores locales (solo para pruebas).

### 2. Subir a Git

```bash
git add .
git commit -m "Preparado para despliegue"
git push
```

### 3. En Render.com

1. **Crear Base de Datos MySQL**:
   - New + → MySQL
   - Name: `traslapp-db`
   - Anota las credenciales

2. **Crear Web Service**:
   - New + → Web Service
   - Conecta tu repositorio Git
   - Environment: PHP
   - Start Command: `php -S 0.0.0.0:$PORT -t .`

3. **Configurar Variables de Entorno**:
   ```
   DB_HOST = [de tu base de datos]
   DB_USER = [de tu base de datos]
   DB_PASSWORD = [de tu base de datos]
   DB_NAME = traslapp_db
   DB_PORT = 3306
   ```

4. **Importar Base de Datos**:
   - Usa `database.sql` desde un cliente MySQL o el panel de Render

### 4. Probar

Accede a: `https://tu-app.onrender.com/index.php`

Login de prueba:
- Documento: `00000001`
- Contraseña: `admin123`

---

## ⚠️ Importante

- **NO subas `conexion.php` a Git** (ya está en `.gitignore`)
- En Render, usa **variables de entorno** para las credenciales
- El plan gratuito de Render **pausa servicios** después de 15 min de inactividad

---

## 📚 Documentación Completa

Lee `DEPLOY.md` para instrucciones detalladas y solución de problemas.

---

## 🔄 Alternativas Gratuitas

Si Render no tiene MySQL gratis disponible:

1. **Railway.app** - Similar a Render, con MySQL gratis
2. **PlanetScale** - MySQL serverless gratis
3. **000webhost** - Hosting PHP/MySQL gratis

---

¡Listo para desplegar! 🎉
