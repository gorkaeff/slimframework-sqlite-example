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

	public function edit($request, $response)
	{
		$isTaskUser = Task::isTaskUser($request->getAttribute(id), $_SESSION['user']);
		if ($isTaskUser){
			$data = [];
			$data['task'] = Task::find($request->getAttribute(id));
			return $this->view->render($response, 'task/edit.twig', ["data" => $data]);
		}
		return $response->withRedirect($this->router->pathFor('home'));
	}

	public function update($request, $response)
	{
		$task = Task::find($request->getAttribute(id));
		$task->name = $request->getParam('name');
		$task->completed = $request->getParam('completed');
		$task->save();
		$this->flash->addMessage('info', 'Task updated!!!');
		return $response->withRedirect($this->router->pathFor('tasks.index'));
	}

	public function destroy($request, $response)
	{
		$isTaskUser = Task::isTaskUser($request->getAttribute(id), $_SESSION['user']);
		if ($isTaskUser){
			Task::destroy($request->getAttribute(id));
			$this->flash->addMessage('info', 'Task deleted!!!');
			return $response->withRedirect($this->router->pathFor('tasks.index'));
		}
		return $response->withRedirect($this->router->pathFor('home'));
	}
}