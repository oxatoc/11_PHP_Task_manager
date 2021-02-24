<form action="<?php echo $dataArray[0]['formAction'] ?>" method="POST">
    <div class="mb-3">
        <label for="input-login" class="form-label">Логин</label>
        <input type="text" class="form-control" name="login" value="" id="input-login"><br>
    </div>
    <div class="mb-3">
        <label for="input-password" class="form-label">Пароль</label>
        <input type="password" class="form-control" name="password" value="" id="input-password"><br>
    </div>
    <button type="subimt" class="btn btn-primary">Отправить</button>
</form>