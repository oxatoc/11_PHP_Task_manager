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
    <div class="global-template">

        <?php 
            use Oxatoc\Taskmanager\NamedRoutesClass;
            use Oxatoc\Taskmanager\CurrentUserClass;

            /* Отображение главного меню */
            if (true){
                echo '<nav class="navbar navbar-expand navbar-light bg-light">';
                    echo '<div class="container-fluid">';
                        echo '<div class="collapse navbar-collapse" id="navbarNav">';
                            echo '<ul class="navbar-nav">';
                                echo '<li class="nav-item">';
                                echo '<a href="'.NamedRoutesClass::index.'" class="nav-link">Список задач</a>';
                                echo '</li>';

                                echo '<li class="nav-item">';
                                echo '<a href="'.NamedRoutesClass::create.'" class="nav-link">Создать новую</a>';
                                echo '</li>';

                                echo '<li class="nav-item">';
                                if (CurrentUserClass::isAdmin()){
                                    echo '<a href="'.NamedRoutesClass::logout.'" class="nav-link">Выход из профиля администратора</a>';
                                } else {
                                    echo '<a href="'.NamedRoutesClass::login.'" class="nav-link">Авторизация</a>';
                                }
                                echo '</li>';
                            echo '</ul>';
                        echo '</div>';
                    echo '</div>';
                echo '</nav>';
            }
        ?>
        
        <?php 
            /* Отображение сообщений, сохраненных в переменных сессии */
            use Oxatoc\Taskmanager\SessionFlashClass;
            if (SessionFlashClass::hasMessage()){
                echo '<div class="alert alert-secondary mt-3 mb-3">';
                echo SessionFlashClass::getMessage();
                echo '</div>';
            }
        ?>

        <?php 
            /* Загрузка представления */
            include __DIR__.'/../../resources/views/'.$viewFile; 
        ?>
    </div>
</body>
</html>