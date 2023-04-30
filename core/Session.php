<?php

namespace Core;
class Session {
    public static function start(): void
    {
        if (!isset($_SESSION))
        {
            session_start();
        }
    }

    public static function set($key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    public static function get($key) {
        return $_SESSION[$key] ?? null;
    }

    public static function has($key): bool
    {
        return isset($_SESSION[$key]);
    }

    public static function remove($key): void
    {
        unset($_SESSION[$key]);
    }

    public static function destroy(): void
    {
        session_destroy();
    }
}
