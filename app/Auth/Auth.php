<?php

namespace App\Auth;

use App\Models\User;

class Auth
{

	public function user()
	{
		if (isset($_SESSION['user'])) {
			return User::find($_SESSION['user']);
		}
	}

	public function check()
	{
		if (isset($_SESSION['user'])) {
			return isset($_SESSION['user']);
		}
	}

	public function attempt($email, $password)
	{
		$user = User::where('email', $email)->first();

		if (!$user) {
			return false;
		}
		
		if (password_verify($password, $user->password)) {
			$_SESSION['user'] = $user->id;
			return true;
		}
		
		return false;
	}
}