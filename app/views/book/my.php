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
foreach($books as $book)
{
?>
		<tr>
			<td><?=$book->name?></td>
			<td><?=$book->authors?></td>
			<td><a href="read.php?book_id=<?=$book->id?>" title="Create a read of this book">Read this</td>
		</tr>
<?php
}
?>
	</tbody>
</table>
				
