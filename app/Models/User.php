<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
	//protected $table = 'the name of the table if is not - users -  called';

	protected $fillable = ['email', 'name', 'password'];

	public function setPassword ($password)
	{
		$this->update([
			'password' => password_hash($password, PASSWORD_DEFAULT)
		]);
	}
}