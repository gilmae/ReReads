<?php

class Account extends Model
{
	public $name = "";
	public $password = "";

	public function find_by_name($name)
	{
		$conn = Repository::get_connection();
		$data = $conn->select("account",
			["id", "created_at", "updated_at", "name", "password"],
			["name"=>$name]
		);

		return Repository::build_first($data, "Account");
	}
}
?>
