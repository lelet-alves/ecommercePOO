<?php
// views/layout/header.php
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<title>Mini E-commerce</title>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<header class="nav">
			<a href="index.php">Home</a>
			<a href="index.php?c=product&a=index">Produtos</a>
			<a href="index.php?c=product&a=add">Adicionar Produto</a>
			<a href="index.php?c=cart&a=index">Carrinho (<?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>)</a>
			<?php if (isset($_SESSION['user'])): ?>
				<span>Olá, <?php echo htmlspecialchars($_SESSION['user']['name']); ?></span>
				<a href="index.php?c=auth&a=logout">Sair</a>
			<?php else: ?>
				<a href="index.php?c=auth&a=login">Login</a>
				<a href="index.php?c=auth&a=register">Registrar</a>
			<?php endif; ?>
		</header>

		<main class="container">
			<?php if (isset($_SESSION['flash'])): ?>
				<div class="flash">
					<?php echo $_SESSION['flash']; unset($_SESSION['flash']); ?>
				</div>
			<?php endif; ?>