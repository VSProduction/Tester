<?php

class Available_prepods extends DB_work {
	
	
	public function getP() {
		
		$buffer = $this->db->Select('Select nick FROM users WHERE prepod=?', array(1));
		$data = array(); 
		while($array = mysql_fetch_array($buffer)) {
			array_push($data, $array); 
			
		} 
		return $data; 
		
	}
	
	public function getV() {
		$this->p_nick = mysql_escape_string($_POST['p_nick']); 
		
		try {
			
			$data = $this->db->getQuery("SELECT id, name FROM pr_".$this->p_nick."_base"); 
			$data['prepod']=$this->p_nick; 
			return $data; 
		//	array_push($data, $this->p_nick); 

		} catch(Exception $e) {
			return "Ни одного теста не найдено!"; 
			
		}
		
		
		
		
		
	}
	
	
	
	
	
}



?>