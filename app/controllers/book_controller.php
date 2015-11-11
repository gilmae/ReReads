<?php
class BookController
{
	public function My()
	{
		$books = Book::all();
		include("app/views/book/my.php");
	} 
}
?>