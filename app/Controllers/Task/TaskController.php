<?php

namespace App\Controllers\Task;

use App\Controllers\Controller;
use App\Models\User;

class TaskController extends Controller
{
	public function index($request, $response)
	{
		$data = [];
		
		if (isset($_SESSION['user'])) {
			$data['tasks'] =  User::find($_SESSION['user'])->tasks;
		}

		return $this->view->render($response, 'task/index.twig', ["data" => $data]);
	}

	public function create($request, $response)
	{
		return "Create TASK";
	}

	public function store($request, $response)
	{
		return "Store TASK";
	}

	public function show($request, $response)
	{
		return "Show TASK";
	}

	public function edit($request, $response)
	{
		return "Edit TASK";
	}

	public function update($request, $response)
	{
		return "Update TASK";
	}

	public function destroy($request, $response)
	{
		return "Destroy TASK";
	}
}