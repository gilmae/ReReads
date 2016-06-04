<?php
  abstract class Model {
    public $id = 0;
    public $created_at;
    public $updated_at;

    public static function all()
    {
      $klass = get_called_class();
      $conn = Repository::get_connection();
      $data = $conn->select($klass, "*");
      return Repository::build_all($data, $klass);
    }

    public static function find($id)
    {
      $klass = get_called_class();
      $conn = Repository::get_connection();
		  $data = $conn->select($klass,
			 "*",
			 ["id"=>$id]
		  );

   		return Repository::build_first($data, $klass);
    }

    public function is_new()
    {
      return $this->id == 0;
    }

    public function inserting()
    {
      $this->created_at = date("Y-m-d H:i:s");
      $this->updated_at = $this->created_at;
    }

    public function updating()
    {
      $this->updated_at = date("Y-m-d H:i:s");
    }

    public function from_array($array)
    {
      foreach(get_object_vars($this) as $attrName => $attrValue)
      {
        if (array_key_exists($attrName, $array)){
          $this->{$attrName} = $array[$attrName];
        }
      }
    }

    public function insert_fields()
  	{
  		$fields = get_object_vars($this);
  		return array_diff($fields, array("id"));
  	}

  	public function update_fields()
  	{
  		$fields = get_object_vars($this);
  		return array_diff($fields, array("id"));
  	}
  }
 ?>
