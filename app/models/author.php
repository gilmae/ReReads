<?php

class Author extends Model
{

  public $name = '';
  
  public function find_by_book($book_id)
  {
    $conn = Model::get_connection();
    
    $data = $conn->select("author", 
      ["[><]book_author" => ["id" => "author_id"]],
      ["author.id", "author.name", "author.created_at", "author.updated_at"],
      ["book_author.book_id"=>$book_id]
    );
    
    return Model::build_all($data, "Author");
  }
  
  
  protected function insert_fields(){
    return [
        "name"=>$this->name,
        "created_at"=>$this->created_at,
        "updated_at"=>$this->updated_at
      ];
  }

  protected function update_fields()
  {
    return [
        "name"=>$this->name,
        "updated_at"=>$this->updated_at
      ];
  }
}

 ?>
