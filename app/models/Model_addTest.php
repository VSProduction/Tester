<?php

class Model_addTest extends Model  {
	
	function __construct() {
		
		$this->data  = new Adding; 
	
	}
	public function addDbName() {
		
				$this->data->addDbName(); 
		
	}
	
	public function addTests() {
			$this->data->addTests($_POST); 
		
	}
	
	
}



?>