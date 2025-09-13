<?php
namespace core;
// app/core/Model.php

class Model
{
	protected $db;

	public function __construct()
	{
		$this->db = \config\Database::getInstance();
	}
}