<?php
namespace controllers;
// app/controllers/ProductController.php

use core\Controller;
use repositories\ProductRepository;
use models\Product;

class ProductController extends Controller
{
	private $repo;

	public function __construct()
	{
		$this->repo = new ProductRepository();
	}

	public function index()
	{
		$products = $this->repo->all();
		$this->view('products/index', ['products' => $products]);
	}

	public function add()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$name = trim($_POST['name']);
			$price = number_format((float)$_POST['price'], 2, '.', '');
			$stock = intval($_POST['stock']);
			if (empty($name)) {
				$error = 'Nome é obrigatório.';
				return $this->view('products/add', ['error' => $error, 'old' => $_POST]);
			}
			$p = new Product([
				'name' => $name,
				'price' => $price,
				'stock' => $stock
			]);
			$ok = $this->repo->create($p);
			if ($ok) {
				$_SESSION['flash'] = 'Produto cadastrado.';
				$this->redirect('index.php?c=product&a=index');
			} else {
				$error = 'Erro ao cadastrar produto.';
				return $this->view('products/add', ['error' => $error, 'old' => $_POST]);
			}
		}
		$this->view('products/add');
	}
}