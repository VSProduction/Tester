<?php

class Session_work {
	
	public function __construct() {
		if(!$_SESSION['nick']) session_start(); 
		
	}
	
	
	public function destroy($param, $param1) {
		
		if($_SESSION[$param]) {
			unset($_SESSION[$param]);
			unset($_SESSION[$param1]);
			session_destroy(); 
			
		}
		
		
	}
	
	
	public function create($array) {
					foreach($array as $key=>$value) {
						
						if(!isset($_SESSION[$key])) {
							session_start(); 
							$_SESSION[$key] = $value; 
							
						}
						
					}
		
	}
	
}


?>