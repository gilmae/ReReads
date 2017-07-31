<?php
require 'application.php';

use PHPUnit\Framework\TestCase;

class ReadServiceTest extends TestCase
{

  public function testGetBook_BookDoesNotExist()
  {
    $service = new BookService();
    $book = $service->GetBook(0);

    $this->assertEquals($book, null);
  }

  public function testGetBook_Exists()
  {
    $service = new BookService();
    $book = $service->GetBook(149);

    $this->assertEquals($book->id, 149);
  }

}
