<?php
  class GoogleService
  {
    public function GetBookByISBN($isbn)
    {
      $client = new Google_Client();
      $client->setDeveloperKey($GLOBALS['google_api_keys']["google_books"]);

      $service = new Google_Service_Books($client);

      $optParams = array();
      $results = $service->volumes->listVolumes(sprintf("isbn:%s", $isbn), $optParams);



      return GoogleService::ParseGoogleResult($results->items[0]);
    }

    public function SearchBooks($searchTerm, $page, $pageSize)
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
         $parsedValues = GoogleService::ParseGoogleResult($item);

         if ($parsedValues->book->isbn13 != "")
         {
           array_push($books, $parsedValues->book);
           $authors[$parsedValues->book->isbn13] = $parsedValues->authors;
          }

      }

      return (object)(array('books'=>$books, 'authors'=>$authors));
    }

    public function ParseGoogleResult($item)
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

        $authors = [];

        if (!empty($item['volumeInfo']['authors']))
        {
          foreach ($item['volumeInfo']['authors'] as $authorItem)
          {
            $author = new Author;
            $author->name = $authorItem;
            array_push($authors, $author);
          }

        }

      return (object)(array("book"=>$book, "authors"=>$authors));
    }
  }
 ?>
