
<?php
// views/products/index.php
?>
<h2>Produtos</h2>
<?php if (empty($products)): ?>
	<p>Nenhum produto cadastrado.</p>
<?php else: ?>
	<table>
		<thead>
			<tr>
				<th>Nome</th>
				<th>Preço</th>
				<th>Estoque</th>
				<th>Ação</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($products as $p): ?>
				<tr>
					<td><?php echo htmlspecialchars($p->name); ?></td>
					<td>R$ <?php echo number_format($p->price, 2, ',', '.'); ?></td>
					<td><?php echo $p->stock; ?></td>
					<td>
						<a href="index.php?c=cart&a=add&id=<?php echo $p->id; ?>">Adicionar ao carrinho</a>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>