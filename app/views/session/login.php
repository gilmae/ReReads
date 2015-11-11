<form action="/i/am" method="POST">
	<label for="name">Name</label> <input id="name" name="name" placeholder="What's your name?" /><span class="error"><?= $html->error_for("name")?></span>
	<label for="password">Password</label> <input id="password" name="password" placeholder="...and your password?" type="password" /><span class="error"><?= $html->error_for("password")?></span>
	<input type="submit" value="Sign in" />	
</form>