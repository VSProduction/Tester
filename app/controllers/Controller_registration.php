<?php

class Controller_registration extends Controller {
	
	public function Action_index() {
		
		$this->view->getView(TEMPL.'registration.html.php');
	}
	
	public function Action_validate() {
		$this->model = new Model_registration;
		
	echo 	$this->model->getData();
	
		
		
	}
	public function Action_check() {
	
		$this->model = new Model_check_registration; 
	$data =	$this->model->getData(); //this is response for Ajax, so ECHO used
	$this->view->getView('registration_check.html.php', $data);
		
	}
	
	

	
}


?>