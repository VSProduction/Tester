<?php
function __autoload($class_name) {
	
	$merger = explode('_', $class_name); // path to class
	switch($merger[0]) {
		case 'Model': 
		$folder = APP.'/models/'; 
		break; 
		case 'Controller': 
		$folder = APP.'/controllers/'; 
		break; 
		case 'View':
		$folder = APP.'/views/'; 
		break; 
		default: 
		$folder = 'classes/';
		
	}

	
	$file_name = strtolower($class_name).'.php'; 
	if(file_exists($folder.$file_name)) {
		
		include($folder.$file_name); 
	} else {
		return false; 
		
	}
	
	
	
	
	
	
}

?>