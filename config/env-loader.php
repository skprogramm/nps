<?php
/**
 * Environment Configuration Loader
 * Loads environment variables from .env file
 */

class EnvLoader {
    private static $loaded = false;
    private static $env = [];
    
    /**
     * Load environment variables from .env file
     */
    public static function load($envFile = null) {
        if (self::$loaded) {
            return self::$env;
        }
        
        if ($envFile === null) {
            $envFile = __DIR__ . '/../.env';
        }
        
        // Check if .env file exists
        if (!file_exists($envFile)) {
            // Fall back to env.php for backward compatibility
            $envPhpFile = __DIR__ . '/env.php';
            if (file_exists($envPhpFile)) {
                self::$env = require $envPhpFile;
                self::$loaded = true;
                return self::$env;
            }
            
            throw new Exception(".env file not found at: " . $envFile);
        }
        
        // Read .env file
        $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        
        foreach ($lines as $line) {
            // Skip comments
            if (strpos(trim($line), '#') === 0) {
                continue;
            }
            
            // Parse key=value pairs
            if (strpos($line, '=') !== false) {
                list($key, $value) = explode('=', $line, 2);
                $key = trim($key);
                $value = trim($value);
                
                // Remove quotes from value
                $value = trim($value, '"\'');
                
                // Convert boolean strings
                if ($value === 'true') {
                    $value = true;
                } elseif ($value === 'false') {
                    $value = false;
                } elseif ($value === 'null') {
                    $value = null;
                } elseif (is_numeric($value)) {
                    $value = is_float($value) ? (float)$value : (int)$value;
                }
                
                self::$env[$key] = $value;
            }
        }
        
        self::$loaded = true;
        return self::$env;
    }
    
    /**
     * Get environment variable
     */
    public static function get($key, $default = null) {
        if (!self::$loaded) {
            self::load();
        }
        
        return isset(self::$env[$key]) ? self::$env[$key] : $default;
    }
    
    /**
     * Get all environment variables
     */
    public static function all() {
        if (!self::$loaded) {
            self::load();
        }
        
        return self::$env;
    }
    
    /**
     * Check if environment variable exists
     */
    public static function has($key) {
        if (!self::$loaded) {
            self::load();
        }
        
        return isset(self::$env[$key]);
    }
}
