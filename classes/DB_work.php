<?php

class DB_work {
	
	
	public function __construct() {
		$this->db = new DataBase(); 
		$this->connect = $this->db->connect('tests'); 
	}
	
	
}


?>