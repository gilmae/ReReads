<?php
  class ReviewService
  {
    public function GetCurrent()
    {
      $conn = Repository::get_connection();
      $data = $conn->select("read",
        ["id","started_at", "completed_at", "book_id", "thoughts", "created_at", "updated_at"],
        ["completed_at"=>null]
      );

      return Repository::build_all($data, "Read");
    }
  }
 ?>
