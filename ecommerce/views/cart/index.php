<?php
// views/cart/index.php
?>
<h2>Seu Carrinho</h2>
<?php if (empty($cart)): ?>
	<p>Seu carrinho está vazio.</p>
<?php else: ?>
	<table>
		<thead>
			<tr>
				<th>Produto</th>
				<th>Preço</th>
				<th>Qtd</th>
				<th>Subtotal</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($cart as $item): ?>
				<tr>
					<td><?php echo htmlspecialchars($item['name']); ?></td>
					<td>R$ <?php echo number_format($item['price'], 2, ',', '.'); ?></td>
					<td><?php echo $item['qty']; ?></td>
					<td>R$ <?php echo number_format($item['price'] * $item['qty'], 2, ',', '.'); ?></td>
					<td><a href="index.php?c=cart&a=remove&id=<?php echo $item['id']; ?>">Remover</a></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<p>Total: R$ <?php echo number_format($total, 2, ',', '.'); ?></p>
	<a href="index.php?c=cart&a=checkout">Finalizar Pedido</a>
<?php endif; ?>