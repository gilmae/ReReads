<h2>Hello <?= $model->name ?></h2>

<h3>My Reads</h3>
<ul>
<?php
$owned_books = Book::find_by_owner($_SESSION["logged_in_user"]);
foreach ($owned_books as $book)
{
	echo($html->render_template("app/views/session/_book_tile.php", array('model'=>$book)));
}
?>	
</ul>

<h4>Add</h4>
<form method="POST" action="/i/add">
 	<div class="form-group">
		<label for="book_id">Book</label>
	 	<select name="book_id" id="book_id" class="form-control>
		<?php
		$books = Book::all();

		foreach ($books as $book)
		{
		?>
			<option value="<?=$book->id?>"><?=$book->name?></option>
		<?php
		}
		?>   
		</select>
	</div>
	<input type="submit" class="btn btn-default" value="Add" />
	
</form>
<?php


?>