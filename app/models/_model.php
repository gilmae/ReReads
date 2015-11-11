<?php
  abstract class Model {
    public $id = 0;
    public $created_at;
    public $updated_at;
    
    public function isNew()
    {
      return $this->id == 0;
    }
  
    protected function inserting()
    {
      $this->created_at = date("Y-m-d H:i:s");
      $this->updated_at = $this->created_at;
    }
     
    protected function updating()
    {
      $this->updated_at = date("Y-m-d H:i:s");
    }
     
    public static function get_connection()
    {
       return new medoo($GLOBALS['connections']['development']);
    }
    
    abstract protected function insert_fields();
    abstract protected function update_fields();
    
    public function Save()
    {
      $conn = Model::get_connection();
      
      if ($this->isNew())
      {
        $this->inserting();
        $this->id = $conn->insert(get_class($this), $this->insert_fields());   
      }
      else
      {
        $this->updating();
        $conn->update(get_class($this), $this->update_fields(), ["id"=>$this->id]);   
      }
    }
      
    protected function from_array($array)
    {
      foreach(get_object_vars($this) as $attrName => $attrValue)
      {
        $this->{$attrName} = $array[$attrName];
      }
    }
    
    protected static function from_arrays($array, $constructor)
    {
       $models = [];
       foreach($array as $item)
       {
         $model = $constructor();
         $model->from_array($item);
         array_push($models, $model);
       }
       return $models;  
    }
  }
 ?>
