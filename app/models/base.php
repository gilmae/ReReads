<?php
  abstract class Model {
    public $id = 0;
    public $created_at;
    public $updated_at;
     
    public function isNew()
    {
      return $this->id == 0;
    }
  
    protected function Inserting()
    {
      $this->created_at = date("Y-m-d H:i:s");
      $this->updated_at = $this->created_at;
      echo($this->created_at);
    }
     
    protected function Updating()
    {
      $this->updated_at = date("Y-m-d H:i:s");
    }
     
    public static function get_connection()
    {
       return new medoo($GLOBALS['connections']['development']);
    }
    
    abstract protected function Insert($conn);
    abstract protected function Update($conn);
    
    public function Save()
    {
      $conn = Model::get_connection();
      
      if ($this->isNew())
      {
        $this->Inserting();
        $this->Insert($conn);   
        //$this->id = $conn->pdo->lastInsertId;     
      }
      else
      {
        $this->Updating();
        $this->Update($conn);
      }
    }
  }
 ?>
