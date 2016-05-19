<?php

class Book extends Model
{

  public $name = '';

  public function find_by_owner($account_id)
  {
    $conn = Model::get_connection();

    $data = $conn->select("book",
      ["[><]collection" => ["id" => "book_id"]],
      ["book.id", "book.name", "book.created_at", "book.updated_at", "book.publisher", "book.publication_year", "book.pages", "books.isbn", "books.isbn13", "books.description"],
      ["collection.account_id"=>$account_id]
    );

    return Model::build_all($data, "Book");
  }

  public function find_by_isbn($isbn)
  {
    $conn = Model::get_connection();

    $data = $conn->select("book",
      ["id", "name", "created_at", "updated_at", "publisher", "publication_year", "pages", "isbn", "isbn13", "Description"],
      ["OR" => ["isbn13"=>$isbn, "isbn"=>$isbn]]
    );

    return Model::build_all($data, "Book");
  }

  protected function insert_fields(){
    $fields = get_object_vars($this);
		return array_diff($fields, array("id"));
  }

  protected function update_fields()
  {
    $fields = get_object_vars($this);
		return array_diff($fields, array("id"));
  }
}

 ?>
