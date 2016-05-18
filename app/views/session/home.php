<h2>Hello <?= $model->user->name ?></h2>

<h3>My Reads</h3>
<ul>
<?php
foreach ($model->owned_books as $book)
{
	echo($html->render_template("app/views/session/_book_tile.php", array('model'=>$book)));
}
?>
</ul>
