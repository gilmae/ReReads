<?php
   class BookSearchService
   {
     public function Search($searchTerm, $page, $pageSize)
     {
       $conn = Repository::get_connection();

       $data = $conn->select("book", [
           "[>]book_author" => ["id" => "book_id"],
           "[>]author" => ["book_author.author_id" => "id"],
         ],
         ["book.id", "book.name", "book.created_at", "book.updated_at", "book.publisher", "book.publication_year", "book.pages", "book.isbn", "book.isbn13", "book.description"],
         [
           "OR"=>[
             "book.name[~]"=>$searchTerm,
             "book.isbn[~]"=>$searchTerm,
             "book.isbn13[~]"=>$searchTerm,
             "author.name[~]"=>$searchTerm
           ],
           "ORDER"=>"book.name",
           "LIMIT"=>[$page, $pageSize]

         ]
       );

       return Repository::build_all($data, "Book");
     }

     
   }
 ?>
