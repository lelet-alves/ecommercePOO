<?php
// views/auth/login.php
?>
<h2>Login</h2>
<?php if (!empty($error)): ?>
	<div class="error">
		<?php echo $error; ?>
	</div>
<?php endif; ?>
<form method="POST" action="index.php?c=auth&a=login">
	<label>Email<br>
		<input type="email" name="email">
	</label><br>
	<label>Senha<br>
		<input type="password" name="password">
	</label><br>
	<button type="submit">Entrar</button>
</form>