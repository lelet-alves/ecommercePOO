<?php
namespace controllers;

use core\Controller;
use repositories\ProductRepository;

class CartController extends Controller
{
	private $repo;

	public function __construct()
	{
		$this->repo = new ProductRepository();
	}

	public function index()
	{
		$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
		$total = 0;
		foreach ($cart as $item) {
			$total += $item['price'] * $item['qty'];
		}
		$this->view('cart/index', ['cart' => $cart, 'total' => $total]);
	}

	public function add()
	{
		$id = intval($_GET['id'] ?? 0);
		if (!$id) {
			$_SESSION['flash'] = 'Produto inválido.';
			$this->redirect('index.php');
		}
		$product = $this->repo->find($id);
		if (!$product) {
			$_SESSION['flash'] = 'Produto não encontrado.';
			$this->redirect('index.php');
		}
		// ensure cart
		if (!isset($_SESSION['cart'])) {
			$_SESSION['cart'] = [];
		}
		// if exists increment
		if (isset($_SESSION['cart'][$id])) {
			$_SESSION['cart'][$id]['qty'] += 1;
		} else {
			$_SESSION['cart'][$id] = [
				'id' => $product->id,
				'name' => $product->name,
				'price' => $product->price,
				'qty' => 1
			];
		}
		$_SESSION['flash'] = 'Produto adicionado ao carrinho.';
		$this->redirect('index.php');
	}

	public function remove()
	{
		$id = intval($_GET['id'] ?? 0);
		if ($id && isset($_SESSION['cart'][$id])) {
			unset($_SESSION['cart'][$id]);
		}
		$this->redirect('index.php?c=cart&a=index');
	}

	public function checkout()
	{
		// For this simple system we'll just clear the cart and show a message
		if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
			$_SESSION['flash'] = 'Carrinho vazio.';
			$this->redirect('index.php?c=cart&a=index');
		}
		// Reduce stock (very naive) and clear cart
		foreach ($_SESSION['cart'] as $item) {
			$prod = $this->repo->find($item['id']);
			if ($prod) {
				$newStock = max(0, $prod->stock - $item['qty']);
				$this->repo->updateStock($prod->id, $newStock);
			}
		}
		unset($_SESSION['cart']);
		$_SESSION['flash'] = 'Pedido finalizado com sucesso.';
		$this->redirect('index.php');
	}
}