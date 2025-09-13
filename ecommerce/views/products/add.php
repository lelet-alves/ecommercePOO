<?php
// views/products/add.php
?>
<h2>Adicionar Produto</h2>
<?php if (!empty($error)): ?>
	<div class="error">
		<?php echo $error; ?>
	</div>
<?php endif; ?>
<form method="POST" action="index.php?c=product&a=add">
	<label>Nome<br>
		<input type="text" name="name" value="<?php echo htmlspecialchars($old['name'] ?? ''); ?>">
	</label><br>
	<label>Preço (ex: 19.90)<br>
		<input type="text" name="price" value="<?php echo htmlspecialchars($old['price'] ?? ''); ?>">
	</label><br>
	<label>Estoque<br>
		<input type="number" name="stock" value="<?php echo htmlspecialchars($old['stock'] ?? 0); ?>">
	</label><br>
	<button type="submit">Salvar Produto</button>
</form>