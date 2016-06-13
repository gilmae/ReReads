<?php
   class BookSearchService
   {
     public function Search($searchTerm, $page, $pageSize)
     {
       $conn = Repository::get_connection();

       $data = $conn->select("book", [
           "[>]book_author" => ["id" => "book_id"],
           "[>]author" => ["book_author.author_id" => "id"],
         ],
         ["book.id", "book.name", "book.created_at", "book.updated_at", "book.publisher", "book.publication_year", "book.pages", "book.isbn", "book.isbn13", "book.description"],
         [
           "OR"=>[
             "book.name[~]"=>$searchTerm,
             "book.isbn[~]"=>$searchTerm,
             "book.isbn13[~]"=>$searchTerm,
             "author.name[~]"=>$searchTerm
           ],
           "ORDER"=>"book.name",
           "LIMIT"=>[$page, $pageSize]

         ]
       );

       return Repository::build_all($data, "Book");
     }

     public function SearchGoogle($searchTerm, $page, $pageSize)
     {
       $authors = [];
       $books = [];

       $client = new Google_Client();
       $client->setDeveloperKey($GLOBALS['google_api_keys']["google_books"]);

       $service = new Google_Service_Books($client);

       $optParams = array();
       $results = $service->volumes->listVolumes($searchTerm, $optParams);

       foreach ($results as $item)
       {
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

   			if ($isbn13!="" )
        {
   				$book = new Book;
   				$book->isbn = $isbn;
   				$book->isbn13 = $isbn13;
   				$book->name = $item->volumeInfo['title'];
   				$book->publisher = $item->volumeInfo['publisher'];
          if (!empty($item->volumeInfo['publishedDate']))
          {
   					$book->publication_year = strftime("%Y", strtotime($item->volumeInfo['']));
   				}
   				$book->description = $item->volumeInfo['description'];
   				$book->pages = $item->volumeInfo['pageCount'];

          $authors[$book->isbn13] = [];

          if (!empty($item['volumeInfo']['authors']))
          {
            foreach ($item['volumeInfo']['authors'] as $authorItem)
            {
              $author = new Author;
              $author->name = $authorItem;
              array_push($authors[$book->isbn13], $author);
            }
            array_push($books, $book);
          }
        }
   		}

      return (object)(array('books'=>$books, 'authors'=>$authors));
     }
   }
 ?>
