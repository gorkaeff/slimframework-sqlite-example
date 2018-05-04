<?php

use Respect\Validation\Validator as v;

session_start();

require __DIR__ . '/../vendor/autoload.php';

$app = new \Slim\App([
	'settings' => [
		'displayErrorDetails' => true,
		'db' => [
			'driver' 	=> 'sqlite',
			'database' 	=> __DIR__ . '/../slimBD.sqlite',
			'prefix'	=> ''
		]
	]
]);

$container = $app->getContainer();

// setup illuminate (Model generator)
$capsule = new Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['validatorController'] = function ($container) {
	return new App\Validation\ValidatorController;
};

// add Illuminate package
$container['db'] = function ($container) use ($capsule){
	return $capsule;
};

$container['view'] = function ($container) {
	$view = new \Slim\Views\Twig(__DIR__ . '/../resources/views', [
		'cache' => false
	]);

	$view->addExtension(new \Slim\Views\TwigExtension(
		$container->router,
		$container->request->getUri()
	));

	return $view;
};

$container['HomeController'] = function ($container){
	return new \App\Controllers\HomeController($container);
};

$container['AuthController'] = function ($container){
	return new \App\Controllers\Auth\AuthController($container);
};

$container['csrf'] = function ($container){
	return new \Slim\Csrf\Guard;
};

$container['auth'] = function ($container){
	return new \App\Auth\Auth;
};

$app->add(new \App\Middelware\ValidationErrorsMiddelware($container));
$app->add(new \App\Middelware\OldInputMiddelware($container));
$app->add(new \App\Middelware\CsrfViewMiddelware($container));
$app->add($container->csrf);

// setup custom rules
v::with('App\\Validation\\Rules\\');

require __DIR__ . '/../app/routes.php';