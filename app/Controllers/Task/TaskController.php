<?php

namespace App\Controllers\Task;

use App\Controllers\Controller;
use App\Models\User;
use App\Models\Task;

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
		return $this->view->render($response, 'task/create.twig');
	}

	public function store($request, $response)
	{

		$task = Task::create([
			'name' => $request->getParam('name'),
			'completed' => $request->getParam('completed'),
			'user_id' => $_SESSION['user']
		]);

		$this->flash->addMessage('info', 'Task stored!!!');

		return $response->withRedirect($this->router->pathFor('tasks.index'));
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