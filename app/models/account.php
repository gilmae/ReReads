<?php

class Account extends Model
{
	public $name = "";
	public $password = "";
	
	public function find_by_name($name)
	{
		$conn = Model::get_connection();
		$data = $conn->select("account", 
			["id", "created_at", "updated_at", "name", "password"],
			["name"=>$name]
		);
		
		return Model::build_first($data, "Account");
	} 
	
	protected function insert_fields()
	{
		return ["name"=>$this->name, 
			"password"=>$this->password
		];
	}

 	protected function update_fields()
	{
		return ["name"=>$this->name, 
			"password"=>$this->password
		];
	}
}
?>