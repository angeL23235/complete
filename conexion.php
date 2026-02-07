<?php
/**
 * Archivo de conexión a la base de datos
 * Compatible con PostgreSQL usando PDO
 * 
 * INSTRUCCIONES:
 * 1. Para producción (Render.com), usa variables de entorno del panel
 * 2. Para desarrollo local, ajusta los valores por defecto
 */

// Configuración usando variables de entorno (recomendado para producción)
// Si no existen, usa valores por defecto (solo para desarrollo local)
$host = getenv('DB_HOST') ?: '127.0.0.1';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASSWORD') ?: '';
$db   = getenv('DB_NAME') ?: 'traslapp_db';
$port = getenv('DB_PORT') ?: '5432';

// Detectar si es PostgreSQL (por el puerto o host)
// En Render, PostgreSQL usa puerto 5432 y el host contiene 'render.com' o 'postgres'
$is_postgresql = ($port == '5432' || strpos($host, 'postgres') !== false || strpos($host, 'render.com') !== false || strpos($host, 'dpg-') !== false);

try {
    if ($is_postgresql) {
        // Conexión PostgreSQL usando PDO
        $dsn = "pgsql:host=$host;port=$port;dbname=$db";
        $con = new PDO($dsn, $user, $pass);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } else {
        // Conexión MySQL usando mysqli (para desarrollo local)
        $con = mysqli_connect($host, $user, $pass, $db, $port);
        if (!$con) {
            die('Error de conexión (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
        }
    }
} catch (PDOException $e) {
    die('Error de conexión a PostgreSQL: ' . $e->getMessage());
} catch (Exception $e) {
    die('Error de conexión: ' . $e->getMessage());
}

// Funciones wrapper para compatibilidad con código mysqli existente
if ($is_postgresql) {
    // Definir constantes si no existen (para compatibilidad)
    if (!defined('MYSQLI_ASSOC')) define('MYSQLI_ASSOC', 2);
    if (!defined('MYSQLI_NUM')) define('MYSQLI_NUM', 1);
    if (!defined('MYSQLI_BOTH')) define('MYSQLI_BOTH', 3);
    
    // Variable global para almacenar el último resultado
    $GLOBALS['_last_pdo_result'] = null;
    $GLOBALS['_last_pdo_statement'] = null;
    
    /**
     * Wrapper para mysqli_query usando PDO
     * Convierte sintaxis MySQL a PostgreSQL automáticamente
     */
    if (!function_exists('mysqli_query')) {
        function mysqli_query($connection, $query) {
            global $_last_pdo_statement;
            try {
                // Convertir backticks (`) a comillas dobles (") para PostgreSQL
                $query = str_replace('`', '"', $query);
                
                $_last_pdo_statement = $connection->query($query);
                return $_last_pdo_statement;
            } catch (PDOException $e) {
                error_log("Error en query: " . $e->getMessage() . " | Query: " . $query);
                return false;
            }
        }
    }
    
    /**
     * Wrapper para mysqli_num_rows usando PDO
     */
    if (!function_exists('mysqli_num_rows')) {
        function mysqli_num_rows($result) {
            if ($result instanceof PDOStatement) {
                return $result->rowCount();
            }
            return 0;
        }
    }
    
    /**
     * Wrapper para mysqli_fetch_array usando PDO
     */
    if (!function_exists('mysqli_fetch_array')) {
        function mysqli_fetch_array($result, $result_type = MYSQLI_BOTH) {
            if ($result instanceof PDOStatement) {
                if ($result_type == MYSQLI_ASSOC || $result_type == 2) {
                    return $result->fetch(PDO::FETCH_ASSOC);
                } elseif ($result_type == MYSQLI_NUM || $result_type == 1) {
                    return $result->fetch(PDO::FETCH_NUM);
                } else {
                    return $result->fetch(PDO::FETCH_BOTH);
                }
            }
            return false;
        }
    }
    
    /**
     * Wrapper para mysqli_fetch_assoc usando PDO
     */
    if (!function_exists('mysqli_fetch_assoc')) {
        function mysqli_fetch_assoc($result) {
            if ($result instanceof PDOStatement) {
                return $result->fetch(PDO::FETCH_ASSOC);
            }
            return false;
        }
    }
    
    /**
     * Wrapper para mysqli_real_escape_string usando PDO
     */
    if (!function_exists('mysqli_real_escape_string')) {
        function mysqli_real_escape_string($connection, $string) {
            if ($connection instanceof PDO) {
                return substr($connection->quote($string), 1, -1); // Remueve las comillas
            }
            return addslashes($string);
        }
    }
    
    /**
     * Wrapper para mysqli_error usando PDO
     */
    if (!function_exists('mysqli_error')) {
        function mysqli_error($connection) {
            if ($connection instanceof PDO) {
                $errorInfo = $connection->errorInfo();
                return $errorInfo[2] ?? '';
            }
            return '';
        }
    }
    
    /**
     * Wrapper para mysqli_insert_id usando PDO
     */
    if (!function_exists('mysqli_insert_id')) {
        function mysqli_insert_id($connection) {
            if ($connection instanceof PDO) {
                // Para PostgreSQL, necesitamos obtener el último ID de una secuencia
                // Esto se hace mejor con RETURNING en el INSERT, pero para compatibilidad:
                $result = $connection->query("SELECT lastval()");
                if ($result) {
                    $row = $result->fetch(PDO::FETCH_NUM);
                    return $row[0] ?? 0;
                }
            }
            return 0;
        }
    }
}

?>
