# Dockerfile para Traslapp en Render
FROM php:8.2-cli

# Instalar extensiones necesarias para PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Establecer directorio de trabajo
WORKDIR /app

# Copiar todos los archivos
COPY . .

# Exponer el puerto (Render usa la variable $PORT)
EXPOSE $PORT

# Comando para iniciar el servidor PHP
CMD php -S 0.0.0.0:$PORT -t .
