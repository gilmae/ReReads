<?php

class Read extends Model
{
  public $started_at;
  public $completed_at;
  public $book_id = 0;
  public $thoughts = '';

  public static function find_by_book_and_account($account_id, $book_id)
  {
    $conn = Repository::get_connection();
    $data = $conn->select("read",
       ["id","started_at", "completed_at", "book_id", "thoughts", "created_at", "updated_at"],
       ["book_id"=>$book_id, "account_id"=>$account_id]
    );

    return Repository::build_all($data, "Read");
  }
}

 ?>
