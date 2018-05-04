<?php

namespace App\Middelware;

class Middelware
{
	protected $container;

	public function __construct($container)
	{
		$this->container = $container;
	}
}