<?php

$app->get('/', 'HomeController:index')->setName('home');

// signup routes
$app->get('/auth/signup', 'AuthController:getSignUp')->setName('auth.signup');
$app->post('/auth/signup', 'AuthController:postSignUp');

// signin routes
$app->get('/auth/signin', 'AuthController:getSignIn')->setName('auth.signin');
$app->post('/auth/signin', 'AuthController:postSignIn');

// signout
$app->get('/auth/signout', 'AuthController:getSignOut')->setName('auth.signout');

// change password
$app->get('/auth/password/change', 'PasswordController:getChangePassword')->setName('auth.password.change');
$app->post('/auth/password/change', 'PasswordController:postChangePassword');