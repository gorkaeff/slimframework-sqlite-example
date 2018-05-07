<?php

namespace App\Middelware;

class AuthMiddelware extends Middelware
{
	public function __invoke($request, $response, $next)
	{
		// check if the user is signed in
		if (!$this->container->auth->check()) {
			$this->container->flash->addMessage('error', 'Please sign in before doing that');
			// flash message
			return $response->withRedirect($this->container->router->pathFor('home'));
		}

		// standard middelware
		$response = $next($request, $response);
		return $response;
	}
}