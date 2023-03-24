<?php

namespace core;

class Session{
    protected const FLASH_KEY = 'flash_messages';
    public function __construct() {
        session_start();
        $_SESSION[self::FLASH_KEY] = $_SESSION[self::FLASH_KEY] ?? [];
        foreach($_SESSION[self::FLASH_KEY] as $key => &$value) {
            $value['remove'] = true;
        }
        $_SESSION[self::FLASH_KEY];
    }
    public function setFlash($key, $message) {
        $_SESSION[self::FLASH_KEY][$key] = [
            'remove' => false,
            'value' => $message
        ];
    }

    public function getFlash($key) {
        return $_SESSION[self::FLASH_KEY][$key]['value'] ?? null;
    }

    public function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public function get($key) {
        return $_SESSION[$key];
    }

    public function remove($key) {
        unset($_SESSION[$key]);
    }

    public function __destruct() {
        $_SESSION[self::FLASH_KEY] = $_SESSION[self::FLASH_KEY] ?? [];
        foreach($_SESSION[self::FLASH_KEY] as $key => &$value) {
            if($value['remove']) {
                unset($_SESSION[self::FLASH_KEY][$key]);
            }
        }
    }
}