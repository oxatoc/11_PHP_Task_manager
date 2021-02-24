<?php

namespace Oxatoc\Taskmanager;

/**
 * Класс для передачи сообщений через хранилище сессии для обработки при следующем запросе HTTP
 */

class SessionFlashClass{

    const KEY = 'flashedMessage';
    /**
     * Запись сообщения
     */
    public static function setMessage($message){
        $_SESSION[self::KEY] = $message;
    }

    /**
     * Извлечение сообщения
     */
    public static function getMessage(){
        $message = '';
        if (self::hasMessage()){
            $message = $_SESSION[self::KEY];
            unset($_SESSION[self::KEY]);
        }
        return $message;
    }

    /**
     * Проверка наличия сообщения
     */
    public static function hasMessage(){
        return isset($_SESSION[self::KEY]);
    }
}