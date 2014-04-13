<?php

Class Model_checkProfile extends DB_work {
	
	
	
	public function Check() {
		
		session_start(); 
		if(!$_SESSION['user-type']) {
	 		$buffer =   $this->db->Select("SELECT prepod FROM users WHERE nick=?", array($_SESSION['nick'])); 
			$buffer=mysql_fetch_array($buffer);
			
			return $buffer[0]; 
				
		
		
		
	 }
		
		
		
	}
	
	
		public function getData($action) {
			$this->prepod = new Available_prepods;
		if($action=='prepod') {
			return $this->prepod->getP(); 
		}	
		if($action=='variants') {
			
			return $this->prepod->getV(); 
		}
			
			
		}
		
		
	
		
		
	
}



?>