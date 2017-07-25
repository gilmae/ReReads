<?php
  class BookService
  {
    public function GetBook($id)
    {
      return Book::find($id);
    }

  }
?>
