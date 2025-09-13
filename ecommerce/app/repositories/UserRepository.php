<?php
namespace repositories;
// app/repositories/UserRepository.php

use core\Model;
use models\User;

class UserRepository extends Model
{
	public function create(User $user)
	{
		$sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
		$stmt = $this->db->prepare($sql);
		return $stmt->execute([
			':name' => $user->name,
			':email' => $user->email,
			':password' => $user->password,
		]);
	}

	public function findByEmail($email)
	{
		$sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
		$stmt = $this->db->prepare($sql);
		$stmt->execute([':email' => $email]);
		$row = $stmt->fetch();
		if (!$row) {
			return null;
		}
		return new User($row);
	}
}