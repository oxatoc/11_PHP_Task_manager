<?php

namespace Oxatoc\Taskmanager;

/**
 * Роутер - единая точка входа
 */

class RouteClass
{
	static function start(){

		$segments = strtok($_SERVER['REQUEST_URI'], '?');
		$segments = explode('/', $segments);

		/* Имя контроллера */
		$controller = 'tasks';
		if (!empty($segments[1])){
			$controller = $segments[1];
		}

		/* Имя метода */
		$method = 'index';
		if (!empty($segments[2])){
			$method = $segments[2];
		}

		/* Создание контроллера */
		$controllerClass = 'Oxatoc\Taskmanager\Controllers'.'\\'.$controller.'_controller';

		$controllerObj = new $controllerClass;

		$controllerObj->$method();


	}
}

