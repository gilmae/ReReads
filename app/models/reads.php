<?php

class Read extends Model
{

  public $read_at;
  public $book_id = 0;
  public $account_id = 0;
  public $thoughts = '';
  
  public static function find_by_book_and_account($account_id, $book_id)
  {
    $conn = Model::get_connection();
    $data = $conn->select("read", 
       ["id","read_at", "book_id", "account_id", "thoughts", "created_at", "updated_at"],
       ["book_id"=>$book_id, "account_id"=>$account_id]
    );

    return Model::build_all($data, "Read");
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
