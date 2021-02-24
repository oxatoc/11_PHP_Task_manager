<form action="<?php echo Oxatoc\Taskmanager\NamedRoutesClass::store ?>" method="POST">
    <div class="mb-1">
        <label for="input-user" class="form-label">Пользователь</label>
        <input type="text" class="form-control" name="user" value="" id="input-user"><br>
    </div>
    <div class="mb-1">
        <label for="input-email" class="form-label">e-mail</label>
        <input type="text" class="form-control" name="email" value="" id="input-email" placeholder="account@domain.com"><br>
    </div>
    <div class="mb-1">
        <label for="input-task" class="form-label">Задача</label>
        <input type="text" class="form-control" name="task" value="" id="input-task"><br>
    </div>
    <button type="subimt" class="btn btn-primary">Отправить</button>
</form>