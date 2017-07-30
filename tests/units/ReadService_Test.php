<?php
require 'application.php';

use PHPUnit\Framework\TestCase;

class ReadServiceTest extends TestCase
{
    public function testGetActive()
    {
      $service = new ReadService();
      $reads = $service->GetActive();
      $this->assertEquals(1, count($reads));
    }
}
?>
