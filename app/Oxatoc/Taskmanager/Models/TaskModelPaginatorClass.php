<?php

namespace Oxatoc\Taskmanager\Models;

class TaskModelPaginatorClass{
    
    private $pdo;
    private $ITEMS_IN_PAGE = 3;

    public function __construct(){
        $config = include __DIR__.'/../../../../config/db.php';
        $this->pdo = new \PDO('mysql:host=127.0.0.1;dbname='.$config['dbName'], $config['dbUser'], $config['dbPassword']);
    }

    /**
     * Возвращает номер последней страницы
     */
    public function lastPage(){
        $total = $this->pdo->query("SELECT COUNT(id) AS total FROM tasks")->fetch();
        return ceil($total['total'] / $this->ITEMS_IN_PAGE);
    }

    /**
     * Возврат всех записей
     */
    public function all(){
        return $this->pdo->query("SELECT * FROM tasks")->fetchAll(\PDO::FETCH_ASSOC);        
    }

    /**
     * Отметка завершения задачи
     */
    public function complete($id){
        $sth = $this->pdo->prepare("UPDATE tasks SET status = 'выполнено'  WHERE id = :id");
        $sth->bindParam(':id', $id, \PDO::PARAM_INT);
        return $sth->execute();
    }

    /**
     * Возврат данных в объеме одной страницы
     * 
     * @param int $pageNumber
     */
    public function items($pageNumber, $orderBy = ''){
        $start = $pageNumber * $this->ITEMS_IN_PAGE;

        $query = "SELECT * FROM tasks".($orderBy != '' ? " ORDER BY {$orderBy}" : '')." LIMIT {$start}, {$this->ITEMS_IN_PAGE}";
        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Добавление записи
     */
    public function insertTask($user, $email, $task){
        $sth = $this->pdo->prepare("INSERT INTO tasks (user, email, task) VALUES (:user, :email, :task)");
        $sth->bindParam(':user', $user, \PDO::PARAM_STR);
        $sth->bindParam(':email', $email, \PDO::PARAM_STR);
        $sth->bindParam(':task', $task, \PDO::PARAM_STR);
        return $sth->execute();
    }

    /**
     * Фабрика фейковых данных
     */
    public function seed(){
        $query = "INSERT INTO tasks (user, email, task) VALUES (:user, :email, :task)";
        $task = $this->pdo->prepare($query);
        for ($i = 0; $i < 15; $i++){
            $index = $i % 5;
            $arr = ['user' => "user $index", 'email' => "email$index@domain.com", 'task' => "task $index"];
            $task->execute($arr);
        }
    }

    /**
     * Возврат отдельной задачи
     */
    public function task($id){
        $sth = $this->pdo->prepare("SELECT id, user, email, task, status FROM tasks WHERE id = :id");
        $sth->bindParam(':id', $id, \PDO::PARAM_INT);
        $sth->execute();
        return $sth->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * Обновление данных задачи
     */
    public function update($id, $user, $email, $task, $status){
        $sth = $this->pdo->prepare(
            "UPDATE tasks SET
             user = :user
            , email = :email
            , task = :task
            , status = :status
            , notes = 'отредактировано администратором'
             WHERE id = :id"
        );
        $sth->bindParam(':user', $user, \PDO::PARAM_STR);
        $sth->bindParam(':email', $email, \PDO::PARAM_STR);
        $sth->bindParam(':task', $task, \PDO::PARAM_STR);
        $sth->bindParam(':status', $status, \PDO::PARAM_STR);
        $sth->bindParam(':id', $id, \PDO::PARAM_INT);
        return $sth->execute();
   }

}