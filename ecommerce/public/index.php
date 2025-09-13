<?php
session_start();

// Very simple autoload
spl_autoload_register(function ($class) {
	$file = __DIR__ . '/../app/' . str_replace('\\', '/', $class) . '.php';
	$file = str_replace('/', DIRECTORY_SEPARATOR, $file);
	// try variations
	$file = str_replace('app/', 'app/', $file);
	if (file_exists($file)) {
		require_once $file;
	}
});

// Basic router using query params: ?c=controller&a=action
$c = isset($_GET['c']) ? $_GET['c'] : 'product';
$a = isset($_GET['a']) ? $_GET['a'] : 'index';
$controller = ucfirst(strtolower($c)) . 'Controller';
$action = $a;

$controllerFile = __DIR__ . '/../app/controllers/' . $controller . '.php';
if (!file_exists($controllerFile)) {
	die('Controller not found');
}
require $controllerFile;
// Instanciar o controller usando o namespace correto
$ctrlClass = "controllers\\$controller";
$ctrl = new $ctrlClass();
if (!method_exists($ctrl, $action)) {
	die('Action not found');
}
$ctrl->$action();