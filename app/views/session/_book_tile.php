	<li>
		<h4><?=$model->name?></h4>
		<h5><?=join(", ", array_map(function($author){return $author->name;}, Author::find_by_book($model->id)))?></h5>
	</li>