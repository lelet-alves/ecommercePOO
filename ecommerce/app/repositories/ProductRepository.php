<?php
namespace repositories;
// app/repositories/ProductRepository.php

use core\Model;
use models\Product;

class ProductRepository extends Model
{
	public function all()
	{
		$stmt = $this->db->query("SELECT * FROM products ORDER BY id DESC");
		$rows = $stmt->fetchAll();
		$res = [];
		foreach ($rows as $r) {
			$res[] = new Product($r);
		}
		return $res;
	}

	public function create(Product $p)
	{
		$sql = "INSERT INTO products (name, price, stock) VALUES (:name, :price, :stock)";
		$stmt = $this->db->prepare($sql);
		return $stmt->execute([
			':name' => $p->name,
			':price' => $p->price,
			':stock' => $p->stock
		]);
	}

	public function find($id)
	{
		$stmt = $this->db->prepare("SELECT * FROM products WHERE id = :id LIMIT 1");
		$stmt->execute([':id' => $id]);
		$r = $stmt->fetch();
		return $r ? new Product($r) : null;
	}

	public function updateStock($id, $newStock)
	{
		$stmt = $this->db->prepare("UPDATE products SET stock = :stock WHERE id = :id");
		return $stmt->execute([
			':stock' => $newStock,
			':id' => $id
		]);
	}
}