<?php

namespace App\Middelware;

class GuestMiddelware extends Middelware
{
	public function __invoke($request, $response, $next)
	{
		// check if the user is signed in
		if ($this->container->auth->check()) {
			return $response->withRedirect($this->container->router->pathFor('home'));
		}

		// standard middelware
		$response = $next($request, $response);
		return $response;
	}
}