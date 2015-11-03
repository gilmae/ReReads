<?php

class Book extends Model
{

  public $name = '';
  public $authors = '';
  
  public static function all()
  {
    $conn = Model::get_connection();
    $books = [];
    $data = $conn->select("book", ["id", "name", "authors", "created_at", "updated_at"]);
    
    foreach ($data as $datum)
    {
       $book = new Book();
       $book->from_array($datum);
       $books.array_push($books, $book);  
    }
    return $books;
  }
  
  public static function find($id)
  {
    $conn = Model::get_connection();
    return $conn->select("book", ["id", "name", "authors", "created_at", "updated_at"], ["id"=>$id]);
  }
  
  protected function insert_fields(){
    return [
        "name"=>$this->name,
        "authors"=>$this->authors,
        "created_at"=>$this->created_at,
        "updated_at"=>$this->updated_at
      ];
  }

  protected function update_fields()
  {
    return [
        "name"=>$this->name,
        "authors"=>$this->authors,
        "updated_at"=>$this->updated_at
      ];
  }
}

 ?>
