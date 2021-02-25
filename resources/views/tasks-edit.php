<form action="<?= $dataArray[0]['formAction'] ?>" method="POST">
    <?php 
        /* Вывод теущих значений полей */
        foreach ($dataArray[0]['task'] as $fieldName => $value){
    ?>
    <div class="mb-3">
    <label for="input-<?=$fieldName?>" class="form-label"><?=$fieldName?></label>
    <input type="text" class="form-control" name="<?=$fieldName?>" value="<?=$value?>" id="input-login"><br>
    </div>
    <?php 
        }
    ?>
    <button type="subimt" class="btn btn-primary">Отправить</button>
</form>