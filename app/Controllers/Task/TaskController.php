<?php

namespace App\Controllers\Task;

use App\Controllers\Controller;
use App\Models\User;

class TaskController extends Controller
{
	public function index($request, $response)
	{
		return $this->view->render($response, 'task/index.twig');
	}
}