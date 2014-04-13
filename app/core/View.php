<?php
class View {
	
	protected $default = 'template/default.html.php'; 
	public function getView($content, $data=NULL, $def=NULL) {
		
		if(is_array($data)) {
			extract($data); 
			
		}
		
	
				require_once($this->default);
	
	
	}
	
}



?>