

<?php 
    /* Добавление кнопок страниц */
    $pagesArray = $dataArray['pages'];
    if (count($pagesArray) > 0){
        echo '<div class="container-pages">';
            echo '<div class="container-pages-header">Страницы:</div>';
            echo '<ul class="pagination mt-3 mb-3">';
                foreach($pagesArray as $page){
                    echo '<li class="page-item'.$page['isActive'].'"><a class="page-link" href="'.$page['href'].'">'.$page['number'].'</a></li>';
                }
            echo '</ul>';
        echo '</div>';
    }
?>


<table class="excel-table">
    <?php 
        /* Добавление заголовка таблицы задач*/
        $tasksArray = $dataArray['tasks'];
        if (count($tasksArray) > 0){
            
            $taskFields = $tasksArray[0];

            echo '<tr>';
            foreach ($taskFields as $fieldName => $field){
                if ($fieldName != 'id'){
                    echo '<td class="excel-table-header">';
                    switch ($fieldName){
                        case 'user': echo 'Пользователь'; break;
                        case 'email': echo 'E-mail'; break;
                        case 'task': echo 'Задача'; break;
                        case 'status': echo 'Статус'; break;
                        case 'notes': echo 'Отметки'; break;
                        default: echo $fieldName; break;
                    }
                    echo "</td>";
                }
            }           

            /* Для администратора отображаем дополнительные столбцы */
            if ($dataArray['userIsAdmin']) {
                echo '<td class="excel-table-icons">Завершить</td>';
                echo '<td class="excel-table-icons">Редактировать</td>';
            }

            echo '</tr>';

            /* Добавление кнопок сортировки данных */

            $sortingButtons = $dataArray['sortingHrefs'];

            echo '<tr>';
            foreach ($taskFields as $fieldName => $field){
                if ($fieldName != 'id'){
                    echo '<td class="excel-table-arrows">';
                    if (in_array($fieldName, array_keys($sortingButtons))){

                        $activeClass = '';

                        echo '<a href="'.$sortingButtons[$fieldName]['ascending']['href'].'" class="btn'.$sortingButtons[$fieldName]['ascending']['active'].'">';
                        echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"></path></svg>';
                        echo '</a>';

                        echo '<a href="'.$sortingButtons[$fieldName]['descending']['href'].'" class="btn'.$sortingButtons[$fieldName]['descending']['active'].'">';
                        echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z"></path></svg>';
                        echo '</a>';

                    }
                    echo "</td>";
                    }
            }
            if ($dataArray['userIsAdmin']) {
                echo '<td class="excel-table-arrows"> </th>';
                echo '<td class="excel-table-arrows"> </th>';
            }

            echo '</tr>';
            
            /* Добавление строк данных задач*/
            foreach ($tasksArray as $taskFields){
                echo '<tr>';
                foreach ($taskFields as $fieldName => $field){
                    if ($fieldName != 'id'){
                        echo '<td class="excel-table-cell">';
                        echo $field;
                        echo "</td>";
                    }
                }
                
                /* Для администратора отображаем дополнительные кнопки отметки задачи как завершенной и редактирования задачи */
                if ($dataArray['userIsAdmin']) {
                    echo '<td class="excel-table-cell">';
                    echo '<a href="'.$dataArray['routeToComplete'].'?'.http_build_query(['id' => $taskFields['id']]) .'" class="btn btn-sm btn-outline-secondary">Выполнено</a>';
                    echo '</td>';

                    echo '<td class="excel-table-cell">';
                    echo '<a href="'.$dataArray['routeToEdit'].'?'.http_build_query(['id' => $taskFields['id']]) .'" class="btn btn-sm btn-outline-secondary">Редактировать</a>';
                    echo '</td>';
                }
                echo '</tr>';
            }
        }
    ?>
</table>

