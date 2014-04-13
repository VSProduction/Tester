<?php

class Model_tests extends DB_work {
	public function __construct() {
		
		$this->name = mysql_escape_string($_POST['name']); 
		$this->number = mysql_escape_string($_POST['number']);
		$this->vars = mysql_escape_string($_POST['var']); 
	
		
	}
	public function getData() {
		
	if($this->name!="") {
				$test = new test_handler; 
$test->getData(); //extract necessary test
$_SESSION["correct"] = $test->to_session(); // install write answers
return  //install the server answer
$test->exec(Test_Handler::question)."___". 
$test->exec(Test_Handler::count_vars)."###".
$test->exec(Test_Handler::vars)."@@@".
$test->exec(Test_Handler::number)."NNN".
$test->generateC_R(); 

	} else {
		
		return '404.html.php'; //если не правильно get запрос
	}

		
		
		
	}
	
	public function getRight() {
		session_start(); 
				if(!isset($this->number)) die('Ошибка программы, пройдите тест заново!'); 
		
	$array = $_SESSION['correct']; 
	
	if($array[$this->number-1]==$this->vars) {
		echo 'good'; 
		$result = 1; 
		
	}  else {
		echo 'bad'; 
		$result = 0; 
	}
		if($result==1) $_SESSION['counter']++; 
		if($_SESSION['test_numbers']==$this->number) {
		
			$test = new test_handler; 
			$test->create_st_db($this->number, $result);
	
	
}
		
		
		
	}
	
	
	
	
}


?>