<?php
class Collection extends Model
{
	public $book_id = 0;
	public $account_id = 0;

	public function insert_fields()
	{
    	return [
        	"book_id"=>$this->book_id,
        	"account_id"=>$this->account_id
      	];
  	}

  	public function update_fields()
  	{
   		return [
    	    "book_id"=>$this->book_id,
    	    "account_id"=>$this->account_id
	      ];
  	}
}
?>
