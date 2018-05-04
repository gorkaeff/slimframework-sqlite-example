<?php

namespace App\Middelware;

class OldInputMiddelware extends Middelware
{
	public function __invoke($request, $response, $next)
	{
		if (isset($_SESSION['old'])) {
			$this->container->view->getEnvironment()->addGlobal('old', $_SESSION['old']);
			$_SESSION['old'] = $request->getParams();
		}
		
		$response = $next($request, $response);
		return $response;
	}
}