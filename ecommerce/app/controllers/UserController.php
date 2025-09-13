<?php
namespace controllers;
// app/controllers/UserController.php

use core\Controller;
use repositories\UserRepository;

class UserController extends Controller
{
	private $repo;

	public function __construct()
	{
		$this->repo = new UserRepository();
	}

	public function register()
	{
		// forward to auth register
		(new AuthController())->register();
	}
}