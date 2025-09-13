<?php
namespace models;
// app/models/User.php

class User
{
	public $id;
	public $name;
	public $email;
	public $password;
	public $created_at;

	public function __construct($data = [])
	{
		foreach ($data as $k => $v) {
			if (property_exists($this, $k)) {
				$this->$k = $v;
			}
		}
	}
}