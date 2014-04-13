<?php

class Model_checkBases extends DB_work {
	
	
	public function getData() {
	session_start(); 
	try {
		
		$this->data = $this->db->getQuery("SELECT * FROM pr_".mysql_escape_string($_SESSION['nick'])."_base"); 
		$this->data['prepod'] = mysql_escape_string($_SESSION['nick']); 
		return $this->data;
			
	} catch(Exception $e) {
		return "Непозволительное имя пользователя!".$e; 
		
	}
	
	

	
		
	}
	
	
	
	
	
	
}



?>