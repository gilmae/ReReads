<?php
class BookUpsertService
{

  public function Upsert($book, $authors)
  {
      if (is_array($book))
      {
         $model = new Book;
         $model->from_array($book);
         Repository::save($model);
      }
  }
}
 ?>
