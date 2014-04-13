<?php


class Controller_student extends Controller {
	
	public function __construct() {
		session_start();
		$this->name = mysql_escape_string($_GET['name']); 
		$this->prepod = mysql_escape_string($_GET['prepod']); 
		$this->view = new View;
	}
	
	
	public function Action_index() {
	
	 
	if($this->name==''||$this->prepod=='') {
		$this->view->getView(TEMPL.'404.html.php'); 
	} else {
			$this->view->getView(TEMPL.'tests.html.php');
	}

		
		
		
	}
	
	public function Action_tests() {
		
			$this->model = new Model_tests; 
			$this->data = $this->model->getData();
			if($this->data=='404.html.php') {
				$this->view->getView(TEMPL.$this->data); 
			}
			

			echo $this->data;
		
	}
	
	public function Action_numbers() {
$this->model = new Model_tests; 
$this->data = $this->model->getRight(); 
		
		
		
	}
	
}

?>