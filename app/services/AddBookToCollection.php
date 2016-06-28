<?php
  class AddBookToCollection
  {
    public function Execute($book, $user)
    {
      $conn = Repository::get_connection();

      // Get User
      if (!is_a($user, 'Account'))
      {
         if (is_int($user))
         {
           echo("get user by id");
           $user = User::find($user);
         }
      }

      if (empty($user))
      {
        throw new Exception("Unknown User");
      }

      // Get the Book trying to add.
      // We assume we have been given one of: an (int) id, a (string) isbn, or a Book
      // If we have a Book, use that, but save it if it is new
      // If we have an int, it is assumed to be an id. Retrieve the book by id, and if we can't find it, abort
      // If we have a string, it is an ISBN. Retrieve the book by ISBN. If we can't find it, try and download the book by ISBN from Google Books.

      if (is_a($book, 'Book'))
      {
        if ($book->is_new)
        {
          Repository::Save($book);
        }
      }
      else
      {
        if (is_int($book)){
          $book = Book::find($book);

          if (empty($book))
          {
            throw new Exception("Cannot find that book");
          }
        }
        else
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

          if (count($data) > 0)
          {
             $book = Repository::build_first($data, "Book");
          }
          else
          {
            $data = GoogleService::GetBookByISBN($book);
            $book = BookUpsertService::Upsert($data->book, $data->authors);
          }
        }
      }

      $collection = new Collection;
      $collection->book_id = $book->id;
      $collection->account_id = $user->id;
      Repository::Save($collection);
    }
  }
?>
