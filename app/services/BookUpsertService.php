<?php
class AddBookToCatalogue
{

  public function Upsert($book, $authors)
  {
      if (is_array($book))
      {
         $model = new Book();
         $model->from_array($book);
         Repository::save($model);
      }
      else if (is_a($book, Book))
      {
         Repository::save($book);
      }

      foreach($authors as $author)
      {
        if (is_a($author, Author))
        {
          Repository::save($author);
        }
        else if (is_array($author))
        {
          $model = new Author();
          $model->from_array($author);
          Repository::save($model);
        }
      }

      return $book;
  }
}
 ?>
