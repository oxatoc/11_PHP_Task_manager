
<div class="container-pages">
    <div class="container-pages-header">Страницы:</div>
    <ul class="pagination mt-3 mb-3">
        <?php foreach($dataArray['pages'] as $page){ ?>
            <li class="<?='page-item'.$page['isActive']?>">
                <a class="page-link" href="<?=$page['href']?>"><?=$page['number']?></a>
            </li>
        <?php } ?>
    </ul>
</div>

<table class="excel-table">
    
    <!-- Заголовок таблицы задач -->
    <tr>
        <?php 
            foreach ($dataArray['headers'] as $fieldName => $field){ 
        ?>
        <td class="excel-table-header"><?= $field ?></td>
        <?php 
            }
            if ($dataArray['userIsAdmin']){
        ?>
        <!-- Дополнительные столбцы администратора -->
        <td class="excel-table-icons">Выполнено</td>
        <td class="excel-table-icons">Редактировать</td>
        <?php 
            } 
        ?>
    </tr>

    <!-- Кнопки сортировки данных -->
    <tr>
        <?php 
            foreach ($dataArray['headers'] as $fieldName => $field) {
                if (in_array($fieldName, array_keys($dataArray['sortingHrefs']))){
        ?>
        <td class="excel-table-arrows">
            <a href="<?=$dataArray['sortingHrefs'][$fieldName]['ascending']['href']?>" class="btn<?=$dataArray['sortingHrefs'][$fieldName]['ascending']['active']?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"></path>
                </svg>
            </a>
            <a href="<?=$dataArray['sortingHrefs'][$fieldName]['descending']['href']?>" class="btn<?=$dataArray['sortingHrefs'][$fieldName]['descending']['active']?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z"></path>
                </svg>
            </a>
        </td>
        <?php
                } else {
        ?>
        <td class="excel-table-arrows"></td>
        <?php
                }
            }
            if ($dataArray['userIsAdmin']){
        ?>
        <!-- Дополнительные столбцы администратора -->
        <td class="excel-table-arrows"></td>
        <td class="excel-table-arrows"></td>
        <?php 
            }
        ?>
    </tr>

    <!-- Строки данных -->
    <?php 
        foreach ($dataArray['tasks'] as $taskFields){ 
    ?>
        <tr>
            <?php 
            foreach ($taskFields as $fieldName => $field){
                if ($fieldName != 'id'){
            ?>
            <td class="excel-table-cell"><?=$field?></td>
            <?php
                }
            }
            if ($dataArray['userIsAdmin']){
            ?>
            <!-- Дополнительные кнопки администратора -->
            <td class="excel-table-cell">
                <a href="<?=$dataArray['routeToComplete'].'?'.http_build_query(['id' => $taskFields['id']])?>" class="btn btn-sm btn-outline-secondary">Выполнено</a>
            </td>
            <td class="excel-table-cell">
                <a href="<?=$dataArray['routeToEdit'].'?'.http_build_query(['id' => $taskFields['id']])?>" class="btn btn-sm btn-outline-secondary">Редактировать</a>
            </td>
        </tr>
    <?php
            }
        }
    ?>
</table>

