<?php

namespace App\Validation\Rules;

use App\Models\User;
use Respect\Validation\Rules\AbstractRule;

class EmailAvailable extends AbstractRule
{
	public function validate($input)
	{
		// check if email exists
		return User::where('email', $input)->count() === 0;
	}
}