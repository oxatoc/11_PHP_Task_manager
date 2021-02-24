<?php

namespace Oxatoc\Taskmanager\Controllers;

class BaseControllerClass{
    protected function showView($viewFile, $dataArray = null){

        if (isset($dataArray)){
            extract($dataArray);
        }
        include  __DIR__.'/../../../../resources/views/global-template.php';
    }
}