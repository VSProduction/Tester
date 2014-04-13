<?php
class Controller_teacher extends Controller {
	
	public function __construct() {
		session_start(); 
		$this->user_type = $_SESSION['user_type']; 
		$this->view = new View; 
			if(!isset($this->user_type)||$this->user_type==0) { // to check is a student or a prepod
			 $this->view->getView('404.html.php'); 
			 }
		
	}
	
	
	public function Action_index() {
		
		
			 $this->model = new Model_checkBases; 
			 $this->data = $this->model->getData(); 
			 $this->view->getView(TEMPL.'checkBases.html.php', $this->data); 
			 
			
		
	}
	
	
	public function Action_add() {
		
	
			
		$this->view->getView(TEMPL.'adding.html.php'); 
	}
	
	public function Action_handler() {
		
		$this->model = new Model_addTest;
		if($this->model->data->table_name=='') $this->view->getView(TEMPL.'404.html.php'); 
		$this->model->addDbname(); 
		
		
	}
	public function Action_Htest() {
		
		$this->model = new Model_addTest; 
		$this->model->addTests(); 
		
	}
	
	
	public function Action_word() {
		
		$this->view->getView(TEMPL.'word.html.php'); 
		
	}
	public function Action_Hword() {
		$this->model = new Model_addTest;
		if($this->model->data->table_name=='') $this->view->getView(TEMPL.'404.html.php'); 
		$this->model->addDbname();
		$this->model = new Model_word; 
		$this->data = $this->model->setData();  
		
	}
	
	
}

?>