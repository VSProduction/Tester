<?php
class Controller_404 extends Controller {
	
	
	
public	function Action_index() {
		$buff = get_class(); 
		$buff = explode('_', $buff); 
		$this->view->getView($this->content.$buff[1].".html.php"); 
		
	}
	
	
	
}



?>