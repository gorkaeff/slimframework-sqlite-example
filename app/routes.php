<?php

use App\Middelware\AuthMiddelware;
use App\Middelware\GuestMiddelware;

$app->get('/', 'HomeController:index')->setName('home');

$app->group('', function(){
	// signup routes
	$this->get('/auth/signup', 'AuthController:getSignUp')->setName('auth.signup');
	$this->post('/auth/signup', 'AuthController:postSignUp');

	// signin routes
	$this->get('/auth/signin', 'AuthController:getSignIn')->setName('auth.signin');
	$this->post('/auth/signin', 'AuthController:postSignIn');
})->add(new GuestMiddelware($container));

$app->group('', function(){
	// signout
	$this->get('/auth/signout', 'AuthController:getSignOut')->setName('auth.signout');

	// change password
	$this->get('/auth/password/change', 'PasswordController:getChangePassword')->setName('auth.password.change');
	$this->post('/auth/password/change', 'PasswordController:postChangePassword');
})->add(new AuthMiddelware($container));

$app->group('/tasks', function(){
	$this->get('', 'TaskController:index')->setName('tasks.index');
	$this->get('/create', 'TaskController:create')->setName('tasks.create');
	$this->post('', 'TaskController:store')->setName('tasks.store');
	$this->get('/{id}', 'TaskController:show')->setName('tasks.show');
	$this->get('/{id}/edit', 'TaskController:edit')->setName('tasks.edit');
	$this->put('/{id}', 'TaskController:update')->setName('tasks.update');
	$this->delete('/{id}', 'TaskController:destroy')->setName('tasks.destroy');
})->add(new AuthMiddelware($container));