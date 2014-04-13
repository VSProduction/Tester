<?php
class Adding  {
	public function __construct() {
		session_start();
		$this->nick = $_SESSION['nick']; 
		$this->db = new DataBase(); 
		$this->db->connect('tests'); 
		$this->sNumber = $_SESSION['number']; 
		$this->names = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'K', 'L'); //letters 
		$this->cNames = array('cA', 'cB', 'cC', 'cD', 'cE', 'cF', 'cG', 'cH', 'cJ', 'cK', 'cL');// correct initials
		$this->baseName = 'pr_'.$this->nick.'_base'; 
		$this->table_name = mysql_escape_string($_POST['table_name']); 
		$this->vc = 'pr_'.$this->nick.'_vc_'; 

		$this->query = array(); 
		$this->response = array(); 
		try {
			$this->db->setNames(); 
			} catch(Exception $e) {
				return $e; 
			}
	
		
	}
	

	
	public function addDbName() {
		$_SESSION['number']=1; // установить существует ли нумерация не с начала
		
		if(!$this->db->exist($this->baseName)) {
			$this->db->DB_table_create($this->baseName, array('id', 'name', 'time_create', 'time_modify'), array('VARCHAR(100)', 'VARCHAR(255)', 'TIMESTAMP', 'TIMESTAMP'));
		}
		$this->checkName(); 
		$this->id =  $this->getId(); 
		$this->db->DB_DATA_INSERT($this->baseName, array('id', 'name'), array('vc_'.$this->id, $this->table_name)); 
		$this->db->DB_table_create($this->vc.$this->id, array('number', 'question', 'correct', 'count_var', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'K', 'L' ), array('INT', 'TEXT', 'VARCHAR(15)', 'INT',   'TEXT', 'TEXT', 'TEXT', 'TEXT', 'TEXT', 'TEXT', 'TEXT', 'TEXT', 'TEXT', 'TEXT', 'TEXT')); 
		$_SESSION['vc_name']='vc_'.$this->id; // to set vc_name
	
		
	}
	
	
	private function checkName() {
	$buffer = 	$this->db->Select('Select name FROM '.$this->baseName.' WHERE name=?', array($this->table_name)); 
	$buffer = mysql_fetch_array($buffer); 
	if(isset($buffer[0])) die('Имя базы данных уже существует!');
		
	}
	
	private function getId() {
		
		try {
			
		$query = $this->db->getQuery('Select id FROM '.$this->baseName.' ORDER BY id DESC LIMIT 1'); 
		$pos = strrpos($query[0]['id'], "_" ); 
						$id = substr($query[0]['id'],$pos+1, strlen($query[0]['id'])); 
						(int)$id++;  
			
		} catch(Exception $e) {
			
		}
		if(!$id) $id=1;
		return $id; 
		
	}
	
	
	public function addTests($array) {
		$this->question = mysql_escape_string($array['question']); 
				$this->StringCorrects = ''; //cтрока правильных вариантов
		if($this->question=='') die('Введите корректное название вопроса!'); 
		array_push($this->query, $_SESSION['number']++); 
		array_push($this->query, $this->question); 
		array_push($this->response, 'number'); 
		array_push($this->response, 'question'); 
	
		
		
		
					for($i=0; $i<count($this->names); $i++) {//to set letters of variants
							$corrects =$array[$this->cNames[$i]]; 
							
					if(isset($corrects)) {
						$this->StringCorrects.=$this->names[$i].','; //to set all correct 
					}
					
							$names = mysql_escape_string($array[$this->names[$i]]); 
						if(isset($names)&&$names!='') {
							array_push($this->response, $this->names[$i]); 
							array_push($this->query, $names); 	
							$count++; 
						}
					}
		$this->StringCorrects = substr($this->StringCorrects, 0,  strlen($this->StringCorrects)-1); 
		array_push($this->query, $this->StringCorrects); 
		array_push($this->query, $count);
		array_push($this->response, 'correct');
		array_push($this->response, 'count_var'); 
		$this->db->DB_DATA_INSERT('pr_'.$this->nick.'_'.$_SESSION['vc_name'], $this->response, $this->query); 
		
	}
	
	
	
	
	
	
}




?>