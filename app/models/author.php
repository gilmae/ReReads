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

  public function find_by_name($name)
  {
    $conn = Model::get_connection();

    $data = $conn->select("author",
      ["id", "name", "created_at", "updated_at"],
      ["name"=>$name]
    );

    return Model::build_first($data, "Author");
  }

  public function link_to_book($book_id){
    $conn = Model::get_connection();

    $conn->insert("book_author", array("book_id"=>$book_id, "author_id"=>$this->id));
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
