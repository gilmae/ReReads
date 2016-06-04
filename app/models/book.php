<?php

class Book extends Model
{

  public $name = '';
  public $publisher = '';
  public $publication_year = '';
  public $pages = 0;
  public $isbn = '';
  public $isbn13 = '';
  public $description = '';

  public function find_by_owner($account_id)
  {
    $conn = Repository::get_connection();

    $data = $conn->select("book",
      ["[><]collection" => ["id" => "book_id"]],
      ["book.id", "book.name", "book.created_at", "book.updated_at", "book.publisher", "book.publication_year", "book.pages", "books.isbn", "books.isbn13", "books.description"],
      ["collection.account_id"=>$account_id]
    );

    return Repository::build_all($data, "Book");
  }

  public function find_by_isbn($isbn)
  {
    $conn = Repository::get_connection();

    $data = $conn->select("book",
      ["id", "name", "created_at", "updated_at", "publisher", "publication_year", "pages", "isbn", "isbn13", "Description"],
      ["OR" => ["isbn13"=>$isbn, "isbn"=>$isbn]]
    );

    return Repository::build_all($data, "Book");
  }
}

 ?>
