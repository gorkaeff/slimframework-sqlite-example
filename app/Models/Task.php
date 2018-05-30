<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Task;

class Task extends Model
{
	protected $table = 'tasks';
	protected $fillable = ['name', 'completed', 'user_id'];

	public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isTaskUser($task_id, $user_id)
    {
        $task = Task::find($task_id);
        if ($task){
            return $task->user->id === $user_id;
        } else {
            return false;
        }
    }
}