<?php

class Controller {
	protected $view; 
	protected $model;
	protected $data; 
	public $content = TEMPL; 
	
	public function __construct() {
		
		$this->view = new View; 
		
	}
	public function Action_index() {
		
	}

	
}


?>