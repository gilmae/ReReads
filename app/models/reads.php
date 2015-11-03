<?php

class Read extends Model
{

  public $read_at;
  public $book_id = 0;
  public $account_id = 0;
  public $thoughts = '';
  
  public static function all()
  {
    //$conn = new medoo($GLOBALS['connections']['development']);
    $conn = Model::get_connection();
    return $conn->select($this-get_class(), ["id","read_at", "book_id", "account_id", "thoughts", "created_at", "updated_at"]);
  }
  
  protected function insert_fields(){
      return [
        "read_at"=>$this->read_at,
        "book_id"=>$this->book_id,
        "thoughts"=>$this->thoughts,
        "account_id"=>$this->account_id,
        "created_at"=>$this->created_at,
        "updated_at"=>$this->updated_at
      ];
  }

  protected function update_fields()
  {
    return [
        "read_at"=>$this->read_at,
        "book_id"=>$this->book_id,
        "account_id"=>$this->account_id,
        "thoughts"=>$this->thoughts,
        "updated_at"=>$this->updated_at
      ];
  }
}

 ?>
