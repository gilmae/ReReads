<?php

class Progress extends Model
{
	public $page = 0;
	public $read_id;
	public $notes = "";


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
