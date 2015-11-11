<?php

class Book extends Model
{

  public $name = '';
  public $authors = '';
  
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
