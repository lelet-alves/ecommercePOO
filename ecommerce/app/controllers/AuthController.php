<?php

namespace controllers;

use core\Controller;
use repositories\UserRepository;
use models\User;

class AuthController extends Controller
{
	private $repo;

	public function __construct()
	{
		$this->repo = new UserRepository();
	}

	public function register()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$name = trim($_POST['name']);
			$email = trim($_POST['email']);
			$pass = $_POST['password'];

			if (empty($name) || empty($email) || empty($pass)) {
				$error = 'Preencha todos os campos.';
				return $this->view('auth/register', ['error' => $error, 'old' => $_POST]);
			}

			if ($this->repo->findByEmail($email)) {
				$error = 'Email já cadastrado.';
				return $this->view('auth/register', ['error' => $error, 'old' => $_POST]);
			}

			$user = new User([
				'name' => $name,
				'email' => $email,
				'password' => password_hash($pass, PASSWORD_BCRYPT)
			]);
			$ok = $this->repo->create($user);
			if ($ok) {
				$_SESSION['flash'] = 'Cadastro realizado com sucesso. Faça login.';
				$this->redirect('index.php?c=auth&a=login');
			} else {
				$error = 'Erro ao cadastrar.';
				return $this->view('auth/register', ['error' => $error, 'old' => $_POST]);
			}
		}
		$this->view('auth/register');
	}

	public function login()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$email = trim($_POST['email']);
			$pass = $_POST['password'];
			$user = $this->repo->findByEmail($email);
			if (!$user || !password_verify($pass, $user->password)) {
				$error = 'Credenciais inválidas.';
				return $this->view('auth/login', ['error' => $error]);
			}
			// login success
			$_SESSION['user'] = [
				'id' => $user->id,
				'name' => $user->name,
				'email' => $user->email
			];
			$_SESSION['flash'] = 'Logado com sucesso.';
			$this->redirect('index.php');
		}
		$this->view('auth/login');
	}

	public function logout()
	{
		session_unset();
		session_destroy();
		header('Location: index.php');
	}
}