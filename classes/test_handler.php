<?php

interface A {
	
	const question=1; 
	const number=2; 
	const correct = 4; 
	const vars = 3; 
	const count_vars = 5;
}


class Test_Handler implements A {
	
	private $action;
	private $db;  
	private $prepod; 
	private $test_name; 
	private $prepare;
	private $data; 
	private $user; 
	private $nick; 
	private $c_r; 
	private $variants = array(); 
	private $numbers = array(); 
	private $questions = array(); 
	private $corrects = array(); 
	private $count_var = array(); 
	private $letters = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'K', 'L'); 
	public function __construct() {
			session_start(); 
			
			if(!(@$_SESSION['nick'])) die('Сессия не установлена'); 
			include('classes/config.php'); // Вот это костыль... пздц... ну а шо поделать!!!
			$this->db = new PDO('mysql:host='.$db_host.';dbname='.$db_name.';charset=UTF8', $db_user, $db_password); 
			$this->db->query("SET NAMES utf8") or die('fasfsaf');
			$this->prepod = @mysql_escape_string($_POST['prepod']); 
			$this->test_name = @mysql_escape_string($_POST['name']); 
			$this->nick = $_SESSION['nick']; 
			$this->studentTable = "pr_".$_SESSION['prepod_name']."_students"; 
			
			
	}
	public function getData() {
		try {
				$_SESSION['prepod_name'] = $this->prepod; //to get prepod into session for last question needed
				$this->prepare = $this->db->prepare("SELECT prepod FROM users WHERE nick=:nick"); 
				$this->prepare->execute(array(':nick'=>$_SESSION['nick']));
				$this->user = $this->prepare->fetch(PDO::FETCH_NUM); 
				$_SESSION['prepod'] = $this->user[0]; 
				$_SESSION['test_name'] = $this->test_name; 
				$_SESSION['counter'] =0; 
				$this->prepare = $this->db->prepare("SELECT name from pr_".$_SESSION['prepod_name']."_base WHERE id=:id"); 
				$this->prepare->execute(array(':id'=>$this->test_name)); 
				$name =  $this->prepare->fetch(PDO::FETCH_NUM); 
				$_SESSION['real_name'] = $name[0]; //test name, that use the author
						$this->prepare = $this->db->prepare("SELECT * FROM pr_".$this->prepod."_".$this->test_name);
						$this->prepare->bindColumn('question', $questions);
						$this->prepare->bindColumn('number', $number);
						$this->prepare->bindColumn('correct', $correct);
						$this->prepare->bindColumn('count_var', $var_counts); 
						for($i=0; $i<count($this->letters); $i++) {
									$this->prepare->bindColumn($this->letters[$i],${$this->letters[$i]} ); 
								}
						$this->prepare->execute() or die('Неправильная выборка'); 
						while($this->data = $this->prepare->fetch(PDO::FETCH_BOUND)) {
							for($i=0; $i<(int)$var_counts; $i++) {
								
								array_push($this->variants, ${$this->letters[$i]} ); 
							}
							array_push($this->count_var,$var_counts ); 
							array_push($this->numbers, $number);
							array_push($this->questions, $questions); 
							array_push($this->corrects, $correct); 	
							
						}
					$_SESSION['test_numbers'] = $this->numbers[count($this->numbers)-1]; 	
						
		} catch (PDOException $e) {
			echo "Данная ошибка произошла:".$e->getMessage(); 
			
		}
			
		
		
		
	}

	private function toJSON($array) {
		
		
		if(empty($array)) return false;
	
		$res = json_encode($array); 
		return $res;
	}
	
	public function exec($param) {
		switch ($param) {
			case 1: 
			$string =  $this->toJSON($this->questions); 
			return preg_replace_callback('/\\\\u([0-9a-f]{4})/i', array($this, 'from_unicode'), $string); //to convert from unicode
			break; 
			case 2: 
			return  $this->toJSON($this->numbers); 
			break; 
			case 3:
			$string =  $this->toJSON($this->variants); 
			return preg_replace_callback('/\\\\u([0-9a-f]{4})/i', array($this, 'from_unicode'), $string); //to convert from unicode
			break; 
			case 4:
			return $this->corrects;
			break; 
			case 5:
			$string =  $this->toJSON($this->count_var); 
			return preg_replace_callback('/\\\\u([0-9a-f]{4})/i', array($this, 'from_unicode'), $string); //to convert from unicode
			break; 
			case 6: 
			return $this->c_r;
			break; 
			default:
			return "Неверный формат данных!"; 
			
			
			
			
		}
		
		
		
	}
	
	
	public function from_unicode($match) {
		
		
		return mb_convert_encoding(pack("H*", $match[1]), "UTF-8", "UCS-2BE"); 
		
	}
	
	public function to_session() {
		
		return  $this->exec(self::correct); 
		
		
	}
	private function createStudentDB($table) {
		//$this->prepare = $this->db->prepare
		$this->dataBase->DB_table_create($table, array('id', 'student',  'summ', 'var_name', 'rating'), array('INT NOT NULL AUTO_INCREMENT', 'TEXT',  'INT', 'VARCHAR(255)', 'INT'));

	}
	
	
	public function create_st_db($var, $result) {
	
		if($_SESSION['prepod']==1) return false; 	
	if(!$this->exist($this->studentTable)) {
		try {
		$this->prepare = $this->db->prepare("CREATE TABLE ".$this->studentTable." (id INT NOT NULL AUTO_INCREMENT, student VARCHAR(255), summ INT, var_name VARCHAR(255), rating INT, name VARCHAR(255), PRIMARY KEY (id)) CHARACTER SET utf8 COLLATE utf8_general_ci "); 
		$this->prepare->execute(); 
		
		} catch(PDOException $e) {
			echo 'Ошибка создания базы данных нового преподавателя!'; 
			
		}

	}
	
		
	try {
	
$this->prepare = $this->db->prepare("INSERT INTO ".$this->studentTable." (summ, student, var_name, rating, name) VALUES (:summ, :student, :var_name, :rating, :name) ") or die('Результат не защитан'); 
$this->prepare->execute(array(':summ'=>$var, ':student'=>$_SESSION['nick'],  ':var_name'=>$_SESSION['test_name'], ':rating'=>$_SESSION['counter'], ':name'=>$_SESSION['real_name']));
	} catch(PDOException $e) {
		
		echo "Результат не засчитан!"; 
	}
	
			
		
	
	
		
		
			
		
		
	}
	
	
	
	
	private function exist($db) {
		
		try {
			$this->prepare = $this->db->prepare("SELECT * FROM ".$db); 
			$this->prepare->execute();
			$buff = $this->prepare->fetchAll();  
		} catch(PDOException $e) {
			
		}
		if(isset($buff)&&empty($buff)) {
			return false; 
		} else {
			return true;
		}
		
	}
	
	
	
	public function generateC_R() {
		$array= array(); 
		if(!isset($_SESSION['correct'])||!(is_array($_SESSION['correct']))) die('Сессия установлена неправильно! Вероятно ошибка в тестах!');
		for($i=0; $i<count($_SESSION['correct']); $i++) {
			if(strlen($_SESSION['correct'][$i])>1) {
							array_push($array, 1); 
							 } else {
							array_push($array, 0); 
								
							 }
			
			
		}
		
		return implode($array,','); 
	}
	
}
?>