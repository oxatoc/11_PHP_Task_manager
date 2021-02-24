<?php

namespace Oxatoc\Taskmanager\Controllers;

use Oxatoc\Taskmanager\NamedRoutesClass;
use Oxatoc\Taskmanager\CurrentUserClass;
use Oxatoc\Taskmanager\SessionFlashClass;

class Auth_Controller extends BaseControllerClass{

    /**
     * Отображение формы аутентификации
     */
    public function login(){
        $this->showView('auth-login.php', [['formAction' => NamedRoutesClass::authStore]]);
    }

    /**
     * Выход из профиля администратора
     */
    public function logout(){
        CurrentUserClass::removeAdminFlag();
        header('Location: '.NamedRoutesClass::index);
    }

    /**
     * Проверка реквизитов аутентификации
     */
    public function store(){
        if ($_POST['login'] == 'admin' && $_POST['password'] == 123){

            CurrentUserClass::setAdminFlag();
            header('Location: '.NamedRoutesClass::index);

        } else if (empty($_POST['login']) || empty($_POST['password'])){

            SessionFlashClass::setMessage('Поля логина и пароля обязательны для заполнения');
            header('Location: '.NamedRoutesClass::login);

        } else if ($_POST['login'] != 'admin' || $_POST['password'] != 123){

            SessionFlashClass::setMessage('Неправильные реквизиты доступа');
            header('Location: '.NamedRoutesClass::login);

        } else {

            header('Location: '.NamedRoutesClass::index);

        }
    }
}