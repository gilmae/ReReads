	<li>
		<h4><?=$model->name?></h4>
		<h5><?=join(
			", ", 
			array_map(
				function($author)
				{
					return $author->name;
				}, 
				Author::find_by_book($model->id)
			)
		)?></h5>
		<form method="POST" action="/i/start_reading">
			<input type="hidden" name="book_id" id="book_id" value="<?=$model->id?>">
			<input type="submit" value="Read" />
		</form>
	</li>