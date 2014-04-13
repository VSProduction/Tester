<?php

class Controller_main extends Controller {
	
	public function __construct() {
		session_start(); 
		if(!$_SESSION['nick']) header("Location: /auth"); 
		$this->view = new View(); 
		
	}
	
	
	public function Action_index() {
	
	 
	 $this->model = new Model_checkProfile; 
	 $this->data = $this->model->Check(); 
	if($this->data==1) {
		
		 $this->data='main_prepod';
		 $data=NULL; 
		 } else {
		 	  $this->data='main_student';
			  $data = $this->model->getData('prepod'); 
			  }
		$this->view->getView(TEMPL.$this->data.'.html.php', $data); 
} 
	
	
	public  function Action_variants() {
		
		

		 $this->model = new Model_checkProfile; 
		 $this->data = $this->model->getData('variants');
		 $this->view->getView(TEMPL.'main_student.html.php', $this->data); 
		/* ////Очень лень созавать вид!!!! Но это неправильно! Но данный вариант
		 for($i=0; $i<count($this->data); $i++) {
		 	echo "<a href='/student/index.php?name=".$array[$i]['id']."&prepod=".$_POST['p_nick']."'>".$array[$i]['name']."</a><br>";
			
		 }
		*/ 

	}
	
	
	
	
}


?>