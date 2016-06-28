<?php

class BookController extends Controller
{
	public function add()
	{
    $this->view("book", "new", null);
  }

  public function add_post($params)
  {
    BookUpsertService::upsert($_POST);
    $this->view("book", "new", null);
  }

  public function search($params)
	{
    // Get the books that match
		$books = BookSearchService::search($_GET["q"], 0, 20);
    $authors = [];
    // Get the authors of all these books
    foreach($books as $book){
			$a = GetAuthorsService::GetForBook($book->id);
			if (!is_array($a))
			{
				$a = array($a);
			}
 		  $authors[$book->isbn13] = $a;
		}

    $this->view("book", "_search_results", (object)array('books'=>$books, 'authors'=>$authors));
	}

	public function search_google($params)
	{
     $books_and_authors = GoogleService::SearchBooks($_GET["q"], 0, 20);
		 $this->view("book", "_search_results", $books_and_authors);
	}
}
?>
