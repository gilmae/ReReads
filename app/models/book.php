<?php

class Book extends Model
{

  public $name = '';
  
  public function find_by_owner($account_id)
  {
    $conn = Model::get_connection();
    
    $data = $conn->select("book", 
      ["[><]collection" => ["id" => "book_id"]],
      ["book.id", "book.name", "book.created_at", "book.updated_at"],
      ["collection.account_id"=>$account_id]
    );

    return Model::build_all($data, "Book");
  }
  
  
  protected function insert_fields(){
    return [
        "name"=>$this->name
      ];
  }

  protected function update_fields()
  {
    return [
        "name"=>$this->name
      ];
  }
}

 ?>
