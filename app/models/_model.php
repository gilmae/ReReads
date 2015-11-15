<?php
  abstract class Model {
    public $id = 0;
    public $created_at;
    public $updated_at;
    
    public static function all()
    {
      $klass = get_called_class();
      $conn = Model::get_connection();
      $data = $conn->select($klass, "*");
      return Model::build_all($data, $klass);
    }

    public static function find($id)
    {
      $klass = get_called_class();
      $conn = Model::get_connection();
		  $data = $conn->select($klass, 
			 "*",
			 ["id"=>$id]
		  );
   
   		return Model::build_first($data, $klass);
    }
    
    public function is_new()
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
       return new medoo($GLOBALS['connections'][$GLOBALS["environment"]]);
    }
    
    abstract protected function insert_fields();
    abstract protected function update_fields();
    
    public function save()
    {
      $conn = Model::get_connection();
      
      
      if ($this->is_new())
      {
        $this->inserting();
        $fields = array("created_at"=>$this->created_at, "updated_at"=>$this->updated_at);
        array_merge($fields, $this->insert_fields());
        
        $this->id = $conn->insert(get_class($this), $fields);   
      }
      else
      {
        $this->updating();
        $fields = array("created_at"=>$this->created_at, "updated_at"=>$this->updated_at);
        array_merge($fields, $this->update_fields());
        
        $conn->update(get_class($this), $fields, ["id"=>$this->id]);   
      }
    }
      
    protected function from_array($array)
    {
      foreach(get_object_vars($this) as $attrName => $attrValue)
      {
        $this->{$attrName} = $array[$attrName];
      }
    }
    
    protected static function build_first($array, $klass)
    {
       if (empty($array) || count($array) == 0)
       {
         return null;
       }
       
       $model = new $klass();
       $model->from_array($array[0]);
       return $model;
    }
    
    protected static function build_all($array, $klass)
    {
       $models = [];
       foreach($array as $item)
       {
         $model = new $klass();
         $model->from_array($item);
         array_push($models, $model);
       }
       return $models;  
    }
  }
 ?>
