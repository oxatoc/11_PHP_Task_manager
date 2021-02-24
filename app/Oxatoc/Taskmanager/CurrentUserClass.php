<?php

namespace Oxatoc\Taskmanager;

/**
 * Класс данных текущего пользователя
 */
class CurrentUserClass{
    
    /**
     * Является ли текущий пользователь админстратором
     */
    public static function isAdmin(){
        if(!isset($_SESSION['authenticated'])){
            return false;
        }
        return true;
    }
    
    /**
     * Снимаем флаг авторизации администратора
     */
    public static function removeAdminFlag(){
        unset($_SESSION['authenticated']);
    }

    /**
     * Устанавливаем флаг авторизации администратора
     */
    public static function setAdminFlag(){
        /* После повышения привелегий пользователя регенерируем ID сессии */
        session_regenerate_id();
        if (!isset($_SESSION['authenticated'])){
            $_SESSION['authenticated'] = true;
        }
    }
}