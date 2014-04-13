<?php

class Model_registration extends Model {
	
	
	public function getData() {
		
		$r = new Registration(); 
		$r->check();
		$data = $r->newUser();
		
		return $data; 
	}
	
	
}


?>