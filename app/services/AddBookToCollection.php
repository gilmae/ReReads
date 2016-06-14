<?php
  class AddBookToCollection
  {
    public function Execute($book, $user)
    {
      $conn = Repository::get_connection();

      if (!is_a($user, 'Account'))
      {
         if (is_int($user))
         {
           echo("get user by id");
           $user = User::find($user);
         }
      }

      $found_book = null;
      if (is_a($book, 'Book'))
      {
        if ($book->is_new)
        {
          Repository::Save($book);
        }

        $found_book = $book;
      }
      else
      {
        if (is_int($book)){
          $found_book = Book::find($book);

          var_dump($found_book);
        }

        if (empty($found_book))
        {
          $data = $conn->select("book",
            "*",
            [
              "OR"=>
              [
                "book.isbn[~]"=>$book,
                "book.isbn13[~]"=>$book,
              ],
              "LIMIT"=>1
            ]
        );

        $found_book = Repository::build_first($data, "Book");
      }
    }

      $collection = new Collection;
      $collection->book_id = $found_book->id;
      $collection->account_id = $user->id;

      var_dump($collection);

      Repository::Save($collection);
    }
  }
?>
