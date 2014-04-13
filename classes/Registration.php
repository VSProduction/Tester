<?php

class Registration  {
		private $db;
		private $connect; 
		private $prefix = "st_"; 
		private $hash;  
		private $nick;
		private $email;
		private $password; 
		private $query; 
		private $prepod; 
		private $session; 
	public function __construct() {

					
		$this->db = new DataBase(); 
		$this->connect = $this->db->connect('tests'); 
		$this->hash = abs(rand(1,12313234332)); 
		$this->nick = mysql_escape_string($_GET['nick']); 
		$this->email = mysql_escape_string($_GET['email']); 
		$this->password = mysql_escape_string($_GET['password']); 
		$this->prepod = mysql_escape_string($_GET['prepod']); 
		define('COMA', ',');
	}
	
	public function check() {
					$buffer =   $this->db->Select("SELECT nick FROM users WHERE nick=?", array($this->nick)); 
					$buffer=mysql_fetch_array($buffer); 
					if(!empty($buffer)) die('This name is already exist!'); 
					$buffer =   $this->db->Select("SELECT nick FROM users WHERE email=?", array($this->email)); 
					$buffer=mysql_fetch_array($buffer); 
					if(!empty($buffer)) die('This email is already exist!'); 

							return true; 
	}
	
	public function newUser() {

		if($this->check()) {
			$this->mailTo(); 
											$query=$this->db->Select("Select id FROM users ORDER BY id DESC LIMIT ?", array(1)); 
											$last_id = mysql_fetch_array($query); //check the last id and add it, its principal 
$this->db->DB_DATA_INSERT("users", array("id", "nick", "email", "password", "check", "hash", "prepod"), array((int)$last_id[0]+1, $this->nick, $this->email, md5($this->password), 0, $this->hash, $this->prepod)); 	// add string with user to db 
return "<p>  Подтвердить регистрацию: <a href='mailto:".$this->email."'>".$this->email."</a></p><a href='/main'> На главную страницу!!! </a>";
			$this->getStarted(); 
		}
		
	}
	
	
	private function mailTo() {
	mail($this->email, 'Activation link', 'Code: http://'.$_SERVER['HTTP_HOST'].'/registration/check/?mail='.$this->hash.'&user='.$this->nick, "Content-type: text/plain; charset ='utf-8'");
		
	}
	
	
	private function getStarted() {
		$this->session =  new Session_work; 
		$this->work->destroy(); 
		
			
	}
	

	
}




?>