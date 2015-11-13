<?php
class Collection extends Model
{
	public $book_id = 0;
	public $account_id = 0;
	
	protected function insert_fields()
	{
    	return [
        	"book_id"=>$this->book_id,
        	"account_id"=>$this->account_id,
        	"created_at"=>$this->created_at,
        	"updated_at"=>$this->updated_at
      	];
  	}

  	protected function update_fields()
  	{
   		return [
    	    "book_id"=>$this->book_id,
    	    "account_id"=>$this->account_id,
        	"updated_at"=>$this->updated_at
	      ];
  	}
}
?>