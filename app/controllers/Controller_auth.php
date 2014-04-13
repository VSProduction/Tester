<?php

Class Controller_auth extends Controller {
	

	
	public function Action_index() {
			$this->model = new Model_auth; 
		$this->view->getView(TEMPL.'auth.html.php'); 
	
		
		
	}
	
	
	public function Action_login() {
		
		$this->model = new Model_auth;
		$data = $this->model->getData(); 
		$this->view->getView(TEMPL.'auth.html.php', $data);
			
	}
	public function Action_exit() {
		session_start(); 
				if(isset($_SESSION)) {
			setcookie(session_name(), session_id(), time()-60*60*24); 
			session_unset();
			session_destroy(); 
			header("Location: main"); 

			
		}
		
	}
	
	

	
}

?>