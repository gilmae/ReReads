<h2>My Books</h2>

<table id="books">
	<thead>
		<tr>
			<th>Title</th>
			<th>Authors</th>
			<th />
		</tr>
	</thead>
	<tbody>
<?php
foreach($model->books as $book)
{
?>
		<tr>
			<td><?=$book->name?></td>
      <td><?php
					if (array_key_exists($book->isbn13, $model->authors))
				 	{
						$f = function($v)
		 				{
		 					return $v->name;
		 				};
					 	echo join(", ", array_map($f, $model->authors[$book->isbn13]));
				 	}
				 ?></td>
			<td><a href="/i/collect/<?=$book->isbn13?>" title="Collect this book">Collect this</td>
		</tr>
<?php
}
?>
	</tbody>
</table>
