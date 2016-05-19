<?php
class BookController
{
	public function search($params)
	{

		$searchTerm = $_GET["q"];
    $client = new Google_Client();
    $client->setDeveloperKey($GLOBALS['google_api_keys']["google_books"]);

    $service = new Google_Service_Books($client);

    $optParams = array();
    $results = $service->volumes->listVolumes($searchTerm, $optParams);

		var_dump($results);

    foreach ($results as $item) {
      $isbn = "";
			$isbn13 = "";
			foreach ($item->volumeInfo['industryIdentifiers'] as $ids) {
				if ($ids['type'] == "ISBN_10") {
					$isbn = $ids['identifier'];
				}
				elseif ($ids['type'] == "ISBN_13") {
					$isbn13 = $ids['identifier'];
				}
			}

			$book = Book::find_by_isbn(array($isbn13, $isbn));
			if (empty($book)){
				$book = new Book;
				$book->isbn = $isbn;
				$book->isbn13 = $isbn13;
				$book->name = $item->volumeInfo['title'];
				$book->publisher = $item->volumeInfo['publisher'];
        if (!empty($item->volumeInfo['publishedDate'])) {
					$book->publication_year = strftime("%Y", strtotime($item->volumeInfo['']));
				}
				$book->description = $item->volumeInfo['description'];

				$book->pages = $item->volumeInfo['pageCount'];

				$book->save();

			  $authors = array();

				if (!empty($item['volumeInfo']['authors'])) {
        	foreach ($item['volumeInfo']['authors'] as $authorItem) {
        	$author = Author::find_by_name($authorItem);

				 		if (empty($author)) {
					 		$author = new Author;
					 		$author->name = $authorItem;
					 		$author->save();
				 		}

						if (!empty($author) && !empty($book)) {
							$author->link_to_book($book->id);
						}
					}
				}
			}
		}
	}
}
?>
