<?php

namespace App\Middelware;

class CsrfViewMiddelware extends Middelware
{
	public function __invoke($request, $response, $next)
	{
		$this->container->view->getEnvironment()->addGlobal('csrf', [
			'field' => '
				<input type="hidden" name="' . $this->container->csrf->getTokenNameKey() . '" id="input1" class="form-control" value="' . $this->container->csrf->getTokenName() . '">
				<input type="hidden" name="' . $this->container->csrf->getTokenValueKey() . '" id="input2" class="form-control" value="' . $this->container->csrf->getTokenValue() . '">
			',
		]);
		
		$response = $next($request, $response);
		return $response;
	}
}