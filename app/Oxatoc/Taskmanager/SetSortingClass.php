<?php

namespace Oxatoc\Taskmanager;

/**
 * Класс сортировки, заданной пользователем
 */
class SetSortingClass{

    /**
     * Возврат критериев сортировки, установленных пользователем
     */
    public static function getSorting(){
        if (!isset($_SESSION['field']) || !isset($_SESSION['direction'])){
            return '';
        } else {
            return $_SESSION['field'].' '.$_SESSION['direction'];
        }
    }

    /**
     * Сохранение настроек сортировки в переменных сессии
     */
    public static function saveSorting($field, $direction){
        $_SESSION['field'] = $field;
        $_SESSION['direction'] = $direction;
    }

    /**
     * Проверка - задана ли сортировка пользователем для заданного поля и направления сортировки
     */
    public static function sortingIsSet($field, $direction){
        if (!isset($_SESSION['field']) || !isset($_SESSION['direction'])){
            return;
        }

        return $_SESSION['field'] == $field && $_SESSION['direction'] == $direction;
    }
}