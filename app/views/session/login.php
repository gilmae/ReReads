<form action="/i/am" method="POST">
	<div class="form-group">
		<label for="name">Name</label> 
		<input id="name" name="name" placeholder="What's your name?" class="form-control" />
		<span class="error"><?= $html->error_for("name")?></span>
	</div>
	<div class="form-group">
		<label for="password">Password</label> 
		<input id="password" name="password" placeholder="...and your password?" type="password" class="form-control" />
		<span class="error"><?= $html->error_for("password")?></span>
	</div>
	<input type="submit" value="Sign in"  class="btn btn-default"" />	
</form>