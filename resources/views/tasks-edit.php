<form action="<?php echo $dataArray[0]['formAction'] ?>" method="POST">

    <?php

        /* Вывод теущих значений полей */
        $task = $dataArray[0]['task'];
        foreach ($task as $fieldName => $value){
            echo '<div class="mb-3">';
            echo '<label for="input-'.$fieldName.'" class="form-label">'.$fieldName.'</label>';
            echo '<input type="text" class="form-control" name="'.$fieldName.'" value="'.$value.'" id="input-login"><br>';
            echo '<div>';
        }
    ?>
    <button type="subimt" class="btn btn-primary">Отправить</button>
</form>