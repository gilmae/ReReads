<?php
   class GetAuthorsService
   {
     public function GetForBook($book_id)
     {
       $conn = Repository::get_connection();

       $data = $conn->select("author",
         ["[><]book_author" => ["id" => "author_id"]],
         ["author.id", "author.name", "author.created_at", "author.updated_at"],
         ["book_author.book_id"=>$book_id]
       );

       return Repository::build_all($data, "Author");
     }
   }
 ?>
