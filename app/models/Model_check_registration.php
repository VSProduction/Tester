<?php

class Model_check_registration extends Model {
	
	public function getData() {
		
		$model = new Registration_check; 
		return  $model->check();
		
	}
	
	
	
	
}


?>