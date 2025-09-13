<?php
// views/auth/register.php
?>
<h2>Registrar</h2>
<?php if (!empty($error)): ?>
	<div class="error">
		<?php echo $error; ?>
	</div>
<?php endif; ?>
<form method="POST" action="index.php?c=auth&a=register">
	<label>Nome<br>
		<input type="text" name="name" value="<?php echo htmlspecialchars($old['name'] ?? ''); ?>">
	</label><br>
	<label>Email<br>
		<input type="email" name="email" value="<?php echo htmlspecialchars($old['email'] ?? ''); ?>">
	</label><br>
	<label>Senha<br>
		<input type="password" name="password">
	</label><br>
	<button type="submit">Registrar</button>
</form>