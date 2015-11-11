<?php

class Account extends Model
{
	public $name = "";
	public $password = "";
	
	public function find($id)
	{
		$conn = Model::get_connection();
		$data = $conn->select("account", 
			["id", "created_at", "updated_at", "name", "password"],
			["id"=>$id]
		);

		if (!empty($data))
		{
			$account = new Account;
		
			$account->from_array($data[0]);
			
			return $account;
		}
		return null;
		
	}
	
	public function find_by_name($name)
	{
		$conn = Model::get_connection();
		$data = $conn->select("account", 
			["id", "created_at", "updated_at", "name", "password"],
			["name"=>$name]
		);

		if (!empty($data))
		{
			$account = new Account;
		
			$account->from_array($data[0]);
			
			return $account;
		}
		return null;
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