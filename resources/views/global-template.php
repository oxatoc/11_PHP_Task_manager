<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
    <?php use Oxatoc\Taskmanager\NamedRoutesClass; ?>
    <?php use Oxatoc\Taskmanager\CurrentUserClass; ?>
    <div class="global-template">
        <nav class="navbar navbar-expand navbar-light bg-light">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="<?php echo NamedRoutesClass::index?>" class="nav-link">Список задач</a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= NamedRoutesClass::create?>" class="nav-link">Создать новую</a>
                        </li>

                        <li class="nav-item">
                        <a href="<?=
                            CurrentUserClass::isAdmin() ? NamedRoutesClass::logout : NamedRoutesClass::login
                            ?>" class="nav-link"><?=
                            CurrentUserClass::isAdmin() ? 'Выход из профиля администратора' : 'Авторизация'
                            ?></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
       
        <?php 
            /* Отображение сообщений, сохраненных в переменных сессии */
            if (Oxatoc\Taskmanager\SessionFlashClass::hasMessage()){
                include __DIR__.'/../../resources/views/flashed-message.php'; 
            }
        ?>

        <?php 
            /* Загрузка представления */
            include __DIR__.'/../../resources/views/'.$viewFile; 
        ?>
    </div>
</body>
</html>