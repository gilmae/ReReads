<?php

class Book extends Model
{

  public $name = '';
  public $authors = '';
  
  public static function all()
  {
    //$conn = new medoo($GLOBALS['connections']['development']);
    $conn = Model::get_connection();
    return $conn->select("books", ["id","name", "authors"]);
  }
  
 
  
  protected function Insert($conn){
    $this->id = $conn->insert("book", [
        "name"=>$this->name,
        "authors"=>$this->authors,
        "created_at"=>$this->created_at,
        "updated_at"=>$this->updated_at
      ]);
      
      
  }

  protected function Update($conn)
  {
    $conn->update("book", [
        "name"=>$this->name,
        "authors"=>$this->authors,
        "updated_at"=>$this->updated_at
      ],
      ["id"=>$this->id]);
  }
}

 ?>
