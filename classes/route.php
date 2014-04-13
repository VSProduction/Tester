<?php

class Route {
	
		
		private $url;
		private $controller;
		private $action; 
		private $controller_name; 
		private $model_name; 
		private $model_class;
		private $controller_class; 
		private $action_name; 
		
public  function go() {
		$this->url = explode('/', $_SERVER['REQUEST_URI']); 
		$this->controller = 'main'; //the default
		$this->action = 'index';
			if(!empty($this->url[1])) {
				$this->controller = $this->url[1]; 
			}
			if(!empty($this->url[2])) {
				$this->action = $this->url[2]; 
			}
		$this->controller_name = 'Controller_'.$this->controller; 
		$this->model_name = 'Model_'.$this->controller; 
		$this->action_name = 'Action_'.$this->action; 
		//Init
		if(file_exists(APP.'models/'.$this->model_name)) {
												include(APP.'models/'.$this->model_name); 
		} 
		 
			if(file_exists(APP.'controllers/'.$this->controller_name.'.php')) {
			
											$this->controller_class = new $this->controller_name; 
		}   else {
				
			$this->controller_class = new Controller_404; 
		} 
		
		
		
			if(method_exists($this->controller_class, $this->action_name)) {
				$buffer = $this->action_name; 
				$this->controller_class->$buffer(); 
				
			}  else {
				$this->controller_class->Action_index(); 
			}
									
		 //
		 
				
					
		
			
			
			
			
			
		} 	
	
	

	
}



?>