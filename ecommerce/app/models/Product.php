<?php
namespace models;
// app/models/Product.php

class Product
{
	public $id;
	public $name;
	public $price;
	public $stock;
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