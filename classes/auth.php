<?php 

Class auth {
	private $db;
	private $connect; 
	private $query; 
	private $password; 
	private $login;
	public function __construct() {
		session_start(); 
				if(isset($_SESSION['nick'])) {
					header("Location: /main"); 	
										}
		$this->db = new DataBase(); 
		$this->connect = $this->db->connect('tests'); 
	}
	
	
	public function check_password($log, $pass) {
		$this->login = mysql_escape_string($log); 
		$this->query = mysql_query("SELECT password, prepod, `check` FROM users WHERE nick='".$this->login."'"); 
			
		$this->password = mysql_fetch_array($this->query); 
		if(empty($this->query)||strcmp(md5($pass), $this->password[0])!=0||$this->password[2]==0) {
		
								if(isset($this->password[2])&&$this->password[2]==0) {
									
									return array("response"=>"<p id='no_valid'>Your e-mail is not verificated yet! </p>"); 
								}
							return array("response"=>"<p id='no_valid'>The pass or login is not valid!  </p>"); 
							
		}  else {
				
				$this->getStarted(); 
			
		}
	}
	
	
	public function setUserType() {
	
		if($this->password[1]=='1') {
			$_SESSION['user_type']=1; 
		} else {
			$_SESSION['user_type']=0; 
		}
		
		
	}
	
	private function getStarted() {
		
	
		session_start(); 
				$_SESSION['nick'] = strtolower($this->login); 
				$this->setUserType(); 
				header('location: /main');
			
	}
	
	
	
	
}





?> 