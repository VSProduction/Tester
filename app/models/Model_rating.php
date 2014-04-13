<?php

class Model_rating extends DB_work {
	private $studentTable; 
	public $props = array(); 
	private $array; 
	
	public function getData() {
		session_start(); 
		$this->studentTable = "pr_".$_SESSION['nick']."_students"; 
		try {
			
			$data = $this->db->getQuery('SELECT student FROM '.$this->studentTable.' GROUP BY student'); 
			
		} catch(Exception $e) {
			
			$data = 'Пройденных тестов нет!';  
			
		}
		
		
		return $data;
		
	}
	
	
	public function Init() {
		 
		$this->props['table'] = '<table id="rating">';
		$this->props['tr']='<tr>';
		$this->props['td']='<td>';
		$this->props['th']='<th>'; 
		$this->props['passed']='<td>'; 
		
				

		

		 	

	}
	
	public function __get($var) {
		$this->Init(); 

		if(array_key_exists($var, $this->props)) {
		
			return $this->props[$var]; 
		} 
		
	}
	
	
	public function getTableData() {
		session_start();
		$this->StudentNick=mysql_escape_string($_GET['nick']);
		try {
		$this->array = 	$this->db->getQuery("SELECT  summ, rating, var_name, name  FROM pr_".$_SESSION['nick']."_students WHERE student='".$this->StudentNick."'");
		} catch (Exception $e) {
			
		return  "Ни одного пройденного студентом теста не обнаружено!"; 
		 
		}
		
		
		return $this->array; 
		
	}
	
	
	
}


?>