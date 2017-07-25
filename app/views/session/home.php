<h2 class="test">Hello </h2>

<h3>Currently Reading</h3>
<ul>
<?php

foreach ($model->reads as $read)
{
	echo($html->render_template("app/views/session/_book_tile.php", array('model'=>$model->books[$read->book_id])));
}
?>
</ul>
