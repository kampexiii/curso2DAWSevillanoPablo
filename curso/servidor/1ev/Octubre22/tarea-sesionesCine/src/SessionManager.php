<?php
// Gestor de sesiones - ahora guarda en data/active_sessions.json las sesiones activas
class SessionManager {
    // Archivo JSON en ../data desde esta carpeta src/
    private static $sessionFile = __DIR__ . '/../data/active_sessions.json';

    // Crear archivo si no existe
    public static function initializeSessionFile() {
        if (!file_exists(self::$sessionFile)) {
            file_put_contents(self::$sessionFile, json_encode([]));
        }
    }

    // Leer sesiones activas
    public static function getActiveSessions() {
        self::initializeSessionFile();
        $sessions = json_decode(file_get_contents(self::$sessionFile), true) ?? [];
        return $sessions;
    }

    // Añadir/actualizar sesión
    public static function addSession($sessionId, $username) {
        $sessions = self::getActiveSessions();
        $sessions[$sessionId] = [
            'username' => $username,
            'login_time' => time()
        ];
        file_put_contents(self::$sessionFile, json_encode($sessions));
    }

    // Eliminar sesión
    public static function removeSession($sessionId) {
        $sessions = self::getActiveSessions();
        if (isset($sessions[$sessionId])) {
            unset($sessions[$sessionId]);
            file_put_contents(self::$sessionFile, json_encode($sessions));
        }
    }

    // Limpiar sesiones expiradas (>24h)
    public static function cleanExpiredSessions() {
        $sessions = self::getActiveSessions();
        $now = time();
        foreach ($sessions as $sessionId => $session) {
            if ($now - $session['login_time'] > 86400) {
                unset($sessions[$sessionId]);
            }
        }
        file_put_contents(self::$sessionFile, json_encode($sessions));
        return $sessions;
    }

    // Validar si existe una sesión concreta
    public static function isValidSession($sessionId) {
        $sessions = self::getActiveSessions();
        return isset($sessions[$sessionId]);
    }

    // Devolver username asociado
    public static function getUsername($sessionId) {
        $sessions = self::getActiveSessions();
        return $sessions[$sessionId]['username'] ?? null;
    }
}
