<?php
   include 'application.php';
   $books = Book::all();
?>

<table>
	<tr>
		<th>Title</th>
		<th>Authors</th>
	</tr>
<?php
	foreach ($books as $book)
	{
?>
	<tr>
		<td><?=$book->name?></td>
		<td><?=$book->authors?></td>
	</tr>
<?php
	}
?>
</table>
	