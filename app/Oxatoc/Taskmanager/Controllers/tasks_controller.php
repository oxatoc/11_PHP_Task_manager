<?php

namespace Oxatoc\Taskmanager\Controllers;

use Oxatoc\Taskmanager\Models\TaskModelPaginatorClass;
use Oxatoc\Taskmanager\NamedRoutesClass;
use Oxatoc\Taskmanager\SetSortingClass;
use Oxatoc\Taskmanager\CurrentUserClass;
use Oxatoc\Taskmanager\SessionFlashClass;

class Tasks_Controller extends BaseControllerClass{
    
    /**
     * Отметка завершения задачи
     */
    public function complete(){
        $id = $_GET['id'];
        $modelObj = new TaskModelPaginatorClass();
        $modelObj->complete($id);

        header('Location: '.NamedRoutesClass::index);
    }

    /* Открытие формы создания новой задачи */
    public function create(){
        $this->showView('tasks-create.php');
    }

    /* Отображение формы редактирования задачи */
    public function edit(){

        $id = $_GET['id'];
        $modelObj = new TaskModelPaginatorClass();
        $task = $modelObj->task($id);
        unset($task['id']);

        $dataArray = [[
            'formAction' => NamedRoutesClass::update.'?'.http_build_query(['id' => $_GET['id']])
            , 'task' => $task
        ]];
        $this->showView('tasks-edit.php', $dataArray);
    }

    /* Отображение всех задач */
    public function index(){

        $modelObj = new TaskModelPaginatorClass();

        /* Создание перечня задач для отображения */
        $page = 0;
        if (!empty($_GET['page'])){
            $page = $_GET['page'];
        }
        $tasksArray = $modelObj->items($page, SetSortingClass::getSorting());

        /* Создание массива кнопок pagination */
        $pages = [];
        $lastPage = $modelObj->lastPage();

        for ($iPage = 0; $iPage < $lastPage; $iPage++){
            $pages[] = [
                'number' => $iPage + 1
                , 'href' => NamedRoutesClass::index.'?'.http_build_query(['page' => $iPage])
                , 'isActive' => $iPage == $page ? ' active' : ''
            ];
        }
    
        /* Создание массива кнопок сортировки */
        $sotringFields = ['user', 'email', 'task'];
        $sortingButtonsArray = [];

        foreach ($sotringFields as $field){

            $sortingButtonsArray[$field] = [
                'ascending' => [
                    'href' => NamedRoutesClass::setSort.'?'.http_build_query(['field' => $field]).'&'.http_build_query(['direction' => 'asc'])
                    , 'active' => SetSortingClass::sortingIsSet($field, 'asc') ? ' btn-outline-secondary' : ''
                    ]
                , 'descending' => [
                    'href' => NamedRoutesClass::setSort.'?'.http_build_query(['field' => $field]).'&'.http_build_query(['direction' => 'desc'])
                    , 'active' => SetSortingClass::sortingIsSet($field, 'desc') ? ' btn-outline-secondary' : ''
                    ]
            ];
        }

        $dataArray = [
            'tasks' => $tasksArray
            , 'pages' => $pages
            , 'sortingHrefs' => $sortingButtonsArray
            , 'userIsAdmin' => CurrentUserClass::isAdmin()
            , 'routeToComplete' => NamedRoutesClass::complete
            , 'routeToEdit' => NamedRoutesClass::edit
        ];

        $this->showView('tasks-index.php', $dataArray);
    }

    /* Сохранение выбранного значения сортировки */
    public function setsort(){

        /* Защита от инжектирования SQL методом белого списка */
        $fields = ['user', 'email', 'task'];
        $fieldsKey = array_search($_GET['field'], $fields);

        $directions = ['asc', 'desc'];
        $directionsKey = array_search($_GET['direction'], $directions);

        if (is_numeric($fieldsKey) && is_numeric($directionsKey)){
            SetSortingClass::saveSorting($fields[$fieldsKey], $directions[$directionsKey]);
        }

        header('Location: '.NamedRoutesClass::index);
    }

    /* Сохранение данных новой задачи */
    public function store(){

        /* Тест пустых полей */
        $emptyFields = array_filter($_POST, function ($val) {
            return strlen($val) == 0;
        });
        if (count($emptyFields) > 0){
            SessionFlashClass::setMessage('не заполнены поля: '.implode(', ', array_keys($emptyFields)));
            header('Location: '.NamedRoutesClass::create);
            return;
        }

        /* Валидация email */
        $email = htmlspecialchars($_POST['email']);

        if (preg_match('/\w+@\w+\.\w+/', $email) != 1){
            SessionFlashClass::setMessage("E-mail не валиден: $email");
            header('Location: '.NamedRoutesClass::create);
            return;
        }

        /* Сохранение задачи */
        $modelObj = new TaskModelPaginatorClass();
        $inserted = $modelObj->insertTask(
                        htmlspecialchars($_POST['user'])
                        , htmlspecialchars($_POST['email'])
                        , htmlspecialchars($_POST['task']));

        SessionFlashClass::setMessage('задача создана');
        header('Location: '.NamedRoutesClass::index);
    }

    /* Сохранение изменений записи */
    public function update(){

        /* Если пользователь не авторизован, то перенаправляем на страницу авторизации */
        if (!CurrentUserClass::isAdmin()){
            header('Location: '.NamedRoutesClass::login);
            return;
        }

        $id = htmlspecialchars($_GET['id']);

        $user = htmlspecialchars($_POST['user']);
        $email = htmlspecialchars($_POST['email']);
        $task = htmlspecialchars($_POST['task']);
        $status = htmlspecialchars($_POST['status']);

        $modelObj = new TaskModelPaginatorClass();
        $modelObj->update($id, $user, $email, $task, $status);

        header('Location: '.NamedRoutesClass::index);
    }
}