<?php

namespace App\Controllers\Api;

use Firebase\JWT\JWT;
use App\Controllers\Controller;
use App\Models\User;

class ApiController extends Controller
{
	public function getToken($request, $response)
	{
		//check email and password
		$emailParameter = $request->getParam("email");
		$passwordParameter = $request->getParam('password');
		$auth = $this->auth->attempt($emailParameter, $passwordParameter);

		//error
		if (!$auth) {
			return $response->withJson("Credentials are not valid!", 400);
		}

		//The user exists and pass the attempt
		$user = User::where('email', $emailParameter)->first();

		//create unique payload with secret key to obtain valid and unique token

    	//iat - Issued at
    	//exp - expiration time
    	//jti - JWT ID
    	//sub - subjet
    	$now = new \DateTime();
		$future = new \DateTime("now +2 hours");
		//$jti = random_bytes(8);
		//$server = $request->getServerParams();
		$payload = [
			"iat" => $now->getTimeStamp(),
        	"exp" => $future->getTimeStamp(),
        	//"jti" => $jti,
        	//"sub" => $server["PHP_AUTH_USER"],
	        "id" => $user->id,
	        "email" => $user->email
	    ];
    	$secret = "supersecretkeyyoushouldnotcommittogithub";

    	//generate TOKEN and return
    	$token = JWT::encode($payload, $secret, "HS256");
    	return $response->withJson($token);
	}

	public function me($request, $response){
		//obtain token with Authentication Bearer tokenXYZ
		//if token is not valid, return 401 by middleware before configured in bootrstrap/app.php
		$token = $request->getAttribute("token");
		$objectJson = [];
		$user = User::find($token['id']);

		$objectJson = [
			"user" => [
				"id" => $user->id,
				"email" => $user->email,
				"name" => $user->name,
				"tasks" => $user->tasks
			]
		];
		return $response->withJson($objectJson);
	}
}