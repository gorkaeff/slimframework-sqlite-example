<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Task;

class User extends Model
{
	//protected $table = 'the name of the table if is not - users -  called';

	protected $fillable = ['id', 'email', 'name', 'password'];

	public function setPassword ($password)
	{
		$this->update([
			'password' => password_hash($password, PASSWORD_DEFAULT)
		]);
	}

	public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}